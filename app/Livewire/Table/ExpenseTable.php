<?php

namespace App\Livewire\Table;

use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExpenseTable extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;

    //DataTable props
	public ?string $query = null;
	public string $orderBy = 'id';
	public string $orderAsc = 'desc';
	public int $perPage = 10;
	public ?array $selected = [];

    //Create, Edit, Delete, View Post props
	public ?string $name = null;
	public ?string $slug = null;
    public ?Expense $expense = null;

    public function render()
    {
        $tempData = Expense::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.expense-table', compact('tempData'));
    }

    public function store()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            Expense::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('expense.alert.success.create'), 'modal-create-expense');
    }

    public function edit()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            $this->expense->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('expense.alert.success.edit'), 'modal-edit-expense');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->expense->delete();
		});

        $this->refreshContent(Lang::get('expense.alert.success.delete'), 'modal-delete-expense');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Expense $expense) {
        $this->expense = $expense;
        $this->name = $expense->name;
        $this->slug = $expense->slug;
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
