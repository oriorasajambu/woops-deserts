<?php

namespace App\Livewire\Table;

use App\Models\Invoice;
use App\Models\Sales;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;

class SalesTable extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;

    //DataTable props
	public ?string $query = null;
	public string $orderBy = 'sales.id';
	public string $orderAsc = 'desc';
	public int $perPage = 10;
	public ?array $selected = [];

    //Create, Edit, Delete, View Post props
	public ?string $invoice_id = null;
	public ?string $user_id = null;
    public ?Sales $sales = null;
    public Collection $invoices;

    //Update & Store Rules
    protected array $rules = [
        'invoice_id'          => 'required|unique:sales,invoice_id',
        'user_id'             => 'nullable',
    ];

    public function mount()
    {
        $this->invoices = Invoice::latest()->get();
    }

    public function render()
    {
        $tempData = Sales::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.sales-table', compact('tempData'));
    }

    public function store()
	{
		$this->validate();

        DB::transaction(function () {
            Sales::create([
                'invoice_id' => $this->invoice_id,
                'user_id' => $this->user_id,
            ]);
		});

        $this->refreshContent(Lang::get('sales.alert.success.create'), 'modal-create-sales');
    }

    public function edit()
	{
		$this->validate();

        DB::transaction(function () {
            $this->sales->update([
                'invoice_id' => $this->invoice_id,
                'user_id' => $this->user_id,
            ]);
		});

        $this->refreshContent(Lang::get('sales.alert.success.edit'), 'modal-edit-sales');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->sales->delete();
		});

        $this->refreshContent(Lang::get('sales.alert.success.delete'), 'modal-delete-sales');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Sales $sales) {
        $this->sales = $sales;
        $this->invoice_id = $sales->invoice_id;
        $this->user_id = $sales->user_id;
    }

    public function refreshContent($message, $modal) {
        //Close the active modal
		$this->dispatch('cancel', $modal);
        session()->flash('message', $message);
        $this->clearFields();
        $refresh;
    }

    public function clearFields()
	{
		$this->reset([
            'invoice_id', 
            'user_id', 
        ]);
	}
}


