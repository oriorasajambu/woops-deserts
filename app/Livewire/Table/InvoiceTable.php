<?php

namespace App\Livewire\Table;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sales;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceTable extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;

    protected $listeners = [
        'initCart' => 'initCart',
    ];

    //DataTable props
	public ?string $query = null;
	public string $orderBy = 'id';
	public string $orderAsc = 'desc';
	public int $perPage = 10;
	public ?array $selected = [];

    //Image upload defaults
	protected string $defThumbName = 'post-thumb.jpg';
	protected string $defThumbPath = 'uploads';

    //Create, Edit, Delete, View Post props
    public $image = null;
    public ?string $email = null;
    public ?string $session = null;
    public ?string $country = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $company = null;
    public ?string $address = null;
    public ?string $city = null;
    public ?string $province = null;
    public ?string $postal_code = null;
    public ?string $phone = null;
    public ?string $orders = null;
    public ?string $sub_total = null;
    public ?string $tax = null;
    public ?string $total = null;
    public ?string $payment_proof = null;
    public ?string $status = null;
    public $sessionId;
    public $carts;
    public ?Invoice $invoice = null;
    public Collection $products;

    //Update & Store Rules
	protected array $rules = [
        'email' => 'bail|required|email:rfc,dns',
        'session' => 'nullable',
        'country' => 'required',
        'first_name' => 'required',
        'last_name' => 'nullable',
        'company' => 'nullable',
        'address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postal_code' => 'required|numeric',
        'phone' => 'required|numeric',
        'orders' => 'required',
        'sub_total' => 'required|numeric',
        'tax' => 'nullable|numeric',
        'total' => 'required|numeric',
        'payment_proof' => 'nullable',
    ];

    public function mount()
	{
		$this->initCart();
	}

    public function render()
    {
        $tempData = Invoice::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.invoice-table', compact('tempData'));
    }

    public function updateToPaid() {
        $order = Order::where('invoice_id', $this->invoice->id)->firstOrFail();
        if ($order) {
            $orders = [];
            foreach((array) json_decode($this->invoice->orders) as $item) {
                array_push($orders, [
                    'name' => $item->name,
                    'variant' => $item->attributes->variant,
                    'quantity' => $item->quantity
                ]);
            }
            $receipt = json_encode([
                'transaction_id' => Str::random(7),
                'transaction_time' => Carbon::now(),
                'orders' => $orders,
                'fullname' => $this->invoice->first_name . ' ' . $this->invoice->last_name,
                'sub_total' => $this->invoice->sub_total,
                'tax' => $this->invoice->tax ?? '0',
                'total' => $this->invoice->total,
                'currency' => 'IDR'
            ]);

            $payment = Payment::create([
                'invoice_id' => $this->invoice->id,
                'session' => $this->invoice->session,
                'receipt' => $receipt,
            ]);

            $sales = Sales::create([
                'invoice_id' => $this->invoice->id,
                'user_id' => Auth::id()
            ]);

            if ($payment && $sales) {
                $isSuccess = $order->update([
                    'payment_id' => $payment->id,
                    'status' => 'inprogress'
                ]);
                if ($isSuccess) {
                    $this->invoice->update([
                        'status' => 'paid',
                    ]);
                    $this->refreshContent('Success Update Status to Paid', 'modal-confirm-invoice');
                }
            }
        }
    }

    public function updateToUploaded() {
        if (!empty($this->image))
        {
            $filename = md5($this->image.microtime()).'_'.Str::random(30).'.'.$this->image->extension();
            $fileLocation = $this->image->storeAs($this->defThumbPath, $filename, 'uploads');
        }
        $this->invoice->update([
            'status' => 'uploaded',
            'payment_proof' => 'storage/'. $fileLocation ?? $this->defThumbName,
        ]);
        $this->refreshContent('Success Update Status to Uploaded', 'modal-upload-invoice');
    }

    public function updateToPending(Invoice $invoice) {
        $invoice->update([
            'status' => 'pending',
            'canceled_by' => 'none',
        ]);
        $this->refreshContent('Success Update Status to Pending', null);
    }

    public function updateToCanceled(Invoice $invoice) {
        $invoice->update([
            'status' => 'canceled',
            'canceled_by' => 'admin',
        ]);
        $this->refreshContent('Success Update Status to Canceled', null);
    }

    public function store()
	{
		$this->validate();

        DB::transaction(function () {
            Invoice::create([
                'session' => $this->sessionId,
                'email' => $this->email,
                'country' => $this->country,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'company' => $this->company,
                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'postal_code' => $this->postal_code,
                'phone' => $this->phone,
                'orders' => $this->orders,
                'sub_total' => $this->sub_total,
                'tax' => $this->tax,
                'total' => $this->total,
                'payment_proof' => $this->payment_proof,
                'status' => 'pending',
            ]);
		});
        \Cart::session($this->sessionId)->clear();

        $this->refreshContent(Lang::get('invoice.alert.success.create'), 'modal-create-invoice');
    }

    public function edit()
	{
		$this->validate();

        DB::transaction(function () {
            $this->invoice->update([
                'email' => $this->email,
                'country' => $this->country,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'company' => $this->company,
                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'postal_code' => $this->postal_code,
                'phone' => $this->phone,
                'orders' => $this->orders,
                'sub_total' => $this->sub_total,
                'tax' => $this->tax,
                'total' => $this->total,
                'payment_proof' => $this->payment_proof,
                'status' => $this->status,
            ]);
		});

        $this->refreshContent(Lang::get('invoice.alert.success.edit'), 'modal-edit-invoice');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->invoice->delete();
		});

        $this->refreshContent(Lang::get('invoice.alert.success.delete'), 'modal-delete-invoice');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    function onClickVariant($id, $value) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'attributes' => array(
                'variant' => $value,
            )
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->sub_total = $cart->getSubTotalWithoutConditions();
        $this->total = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function incrementQuantity($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'quantity' => 1
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->sub_total = $cart->getSubTotalWithoutConditions();
        $this->total = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function decrementQuantity($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->update($id,[
            'quantity' => -1
        ]);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->sub_total = $cart->getSubTotalWithoutConditions();
        $this->total = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    function remove($id) 
    {
        $cart = \Cart::session($this->sessionId);
        $cart->remove($id);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->sub_total = $cart->getSubTotalWithoutConditions();
        $this->total = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    public function initData(Invoice $invoice) {
        $this->invoice = $invoice;
        $this->email = $invoice->email;
        $this->country = $invoice->country;
        $this->first_name = $invoice->first_name;
        $this->last_name = $invoice->last_name;
        $this->company = $invoice->company;
        $this->address = $invoice->address;
        $this->city = $invoice->city;
        $this->province = $invoice->province;
        $this->postal_code = $invoice->postal_code;
        $this->phone = $invoice->phone;
        $this->orders = $invoice->orders;
        $this->sub_total = $invoice->sub_total;
        $this->tax = $invoice->tax;
        $this->total = $invoice->total;
        $this->payment_proof = $invoice->payment_proof;
        $this->status = $invoice->status;
    }

    public function initCart() {
        $this->products = Product::all();
        $this->sessionId = session()->getId();
        $cart = \Cart::session($this->sessionId);
        $sorted = collect($cart->getContent())->sortDesc();
        $this->carts = $sorted;
        $this->sub_total = $cart->getSubTotalWithoutConditions();
        $this->total = $cart->getSubTotal();
        $this->orders = $cart->getContent()->toJson();
    }

    public function refreshContent(?string $message = null, ?string $modal = null) {
        //Close the active modal
        if ($modal) {
            $this->dispatch('cancel', $modal);
        }
        if ($message) {
            session()->flash('message', $message);
        }
        $this->clearFields();
        $refresh;
    }

    public function clearFields()
	{
		$this->reset([
            'email',
            'country',
            'first_name',
            'last_name',
            'company',
            'address',
            'city',
            'province',
            'postal_code',
            'phone',
            'orders',
            'sub_total',
            'tax',
            'total',
            'payment_proof',
            'status',
        ]);
	}

    public function download(Invoice $invoice) {
        return response()->download( 
            $invoice->payment_proof
        );
    }
}
