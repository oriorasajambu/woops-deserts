<?php

namespace App\Livewire\Table;

use App\Models\Invoice;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class OrderTable extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;

    //DataTable props
	public ?string $query = null;
	public string $orderBy = 'id';
	public string $orderAsc = 'desc';
	public int $perPage = 10;
	public ?array $selected = [];

    //Create, Edit, Delete, View Post props
	public ?string $user_id = null;
	public ?string $invoice_id = null;
	public ?string $session = null;
	public ?string $status = null;
    public ?Order $order = null;
    public Collection $invoices;

    //Update & Store Rules
	protected array $rules = [
        'invoice_id' => 'required|unique:orders,invoice_id',
        'user_id' => 'nullable',
        'session' => 'nullable',
    ];

    public function mount()
	{
		$this->invoices = Invoice::latest()->get();
	}

    public function render()
    {
        $tempData = Order::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.order-table', compact('tempData'));
    }

    public function updateToFinish(Order $orders) {
        $orders->update([
            'status' => 'finish'
        ]);
        $this->refreshContent("Success Update Status to Finish", null);
    }

    public function updateToInProgress(Order $orders) {
        $orders->update([
            'status' => 'inprogress'
        ]);
        $this->refreshContent("Success Update Status to In Progress", null);
    }

    public function updateToPending(Order $orders) {
        $orders->update([
            'status' => 'pending'
        ]);
        $this->refreshContent("Success Update Status to Pending", null);
    }

    public function updateToCanceled(Order $orders) {
        $orders->update([
            'status' => 'canceled'
        ]);
        $this->refreshContent("Success Update Status to Canceled", null);
    }

    public function store()
	{
		$this->validate();

        DB::transaction(function () {
            Order::create([
                'user_id' => Auth::id(),
                'invoice_id' => $this->invoice_id,
                'session' => session()->getId(),
                'status' => 'pending',
            ]);
		});

        $this->refreshContent(Lang::get('order.alert.success.create'), 'modal-create-order');
    }

    public function edit()
	{
		$this->validate();

        DB::transaction(function () {
            $this->order->update([
                'user_id' => Auth::id(),
                'invoice_id' => $this->invoice_id,
                'session' => $this->session,
                'status' => $this->status,
            ]);
		});

        $this->refreshContent(Lang::get('order.alert.success.edit'), 'modal-edit-order');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->order->delete();
		});

        $this->refreshContent(Lang::get('order.alert.success.delete'), 'modal-delete-order');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Order $order) {
        $this->order = $order;
        $this->user_id = $order->user_id;
        $this->invoice_id = $order->invoice_id;
        $this->session = $order->session;
        $this->status = $order->status;
    }

    public function refreshContent($message, ?string $modal) {
        //Close the active modal
        if ($modal) {
            $this->dispatch('cancel', $modal);
        }
        session()->flash('message', $message);
        $this->clearFields();
        $refresh;
    }

    public function clearFields()
	{
		$this->reset([
            'user_id', 
            'invoice_id', 
            'session', 
            'status', 
        ]);
	}
}
