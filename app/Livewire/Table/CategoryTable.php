<?php

namespace App\Livewire\Table;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryTable extends Component
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
    public ?Category $category = null;

    //Update & Store Rules
	protected array $rules = [
        'name' => 'bail|required|min:3',
        'slug' => 'unique:categories,slug',
    ];

    public function render()
    {
        $tempData = Category::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.category-table', compact('tempData'));
    }

    public function store()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            Category::create([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('category.alert.success.create'), 'modal-create-category');
    }

    public function edit()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            $this->category->update([
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
		});

        $this->refreshContent(Lang::get('category.alert.success.edit'), 'modal-edit-category');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->category->delete();
		});

        $this->refreshContent(Lang::get('category.alert.success.delete'), 'modal-delete-category');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Category $category) {
        $this->category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
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
