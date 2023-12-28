<?php

namespace App\Livewire\Table;

use App\Models\Payment;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PaymentTable extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;

    //DataTable props
	public ?string $query = null;
	public string $orderBy = 'payments.id';
	public string $orderAsc = 'desc';
	public int $perPage = 10;
	public ?array $selected = [];

    //Create, Edit, Delete, View Post props
	public ?string $name = null;
	public ?string $slug = null;
    public ?Payment $payment = null;

    public function render()
    {
        $tempData = Payment::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.payment-table', compact('tempData'));
    }

    public function store()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            Payment::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('payment.alert.success.create'), 'modal-create-payment');
    }

    public function edit()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            $this->payment->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('payment.alert.success.edit'), 'modal-edit-payment');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->payment->delete();
		});

        $this->refreshContent(Lang::get('payment.alert.success.delete'), 'modal-delete-payment');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Payment $payment) {
        $this->payment = $payment;
        $this->name = $payment->name;
        $this->slug = $payment->slug;
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
            'name', 
            'slug', 
        ]);
	}
}
