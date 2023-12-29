<?php

namespace App\Livewire\Table;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ProductTable extends Component
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
	public ?string $description = null;
	public ?string $variant = null;
	public ?string $price = null;
    public $image = null;
	public ?int $product_id = null;
	public ?int $category_id = null;
	public ?string $categoryName = null;
	public ?Product $product = null;

    public Collection $categories;

    public ?int $selectedCategory = null;

    //Image upload defaults
	protected string $defThumbName = 'post-thumb.jpg';
	protected string $defThumbPath = 'uploads';

    //Update & Store Rules
	protected array $rules = [
        'category_id'   => 'required',
        'name'          => 'required|min:5',
        'description'   => 'required|min:5',
        'price'         => 'required|numeric',
        'image'         => 'required|mimes:jpeg,png,jpg,gif|max:4096',
    ];

    protected array $validationAttributes = [
		'category_id'      => 'Category',
		'selectedCategory' => 'Category',
	];

    public function mount()
	{
		$this->categories = Category::all();
	}

    public function render()
    {
        $tempData = Product::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.product-table', compact('tempData'));
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function store()
	{
		$this->validate();

        DB::transaction(function () {
			if (!empty($this->image))
            {
                $filename = md5($this->image.microtime()).'_'.Str::random(30).'.'.$this->image->extension();
                $fileLocation = $this->image->storeAs($this->defThumbPath, $filename, 'uploads');
            }

            Product::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'variant' => json_encode(explode(",", $this->variant)),
                'price' => $this->price,
                'image' => 'storage/'. $fileLocation ?? $this->defThumbName,
                'original' => 'storage/'. $fileLocation ?? $this->defThumbName,
                'category_id' => $this->category_id,
                'user_id' => Auth::id(),
            ]);
		});

        $this->refreshContent(Lang::get('product.alert.success.create'), 'modal-create-product');
    }

    public function edit()
	{
		$this->validate();

        DB::transaction(function () {
			if (!empty($this->image))
            {
                $filename = md5($this->image.microtime()).'_'.Str::random(30).'.'.$this->image->extension();
                $fileLocation = $this->image->storeAs($this->defThumbPath, $filename, 'uploads');
            }

            $this->product->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'variant' => json_encode(explode(",", $this->variant)),
                'price' => $this->price,
                'image' => 'storage/'. $fileLocation ?? $this->defThumbName,
                'original' => 'storage/'. $fileLocation ?? $this->defThumbName,
                'category_id' => $this->category_id,
                'user_id' => '1',
            ]);
		});

        $this->refreshContent(Lang::get('product.alert.success.create'), 'modal-edit-product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete()
    {
        $storage = Storage::disk('uploads');
        $thumbnail = str_replace('storage/', '', $this->product->image);
        $original = str_replace('storage/', '', $this->product->original);
        if ($storage->exists($thumbnail) && $storage->exists($original)) :
            $storage->delete($thumbnail);
            $storage->delete($original);
        endif;
        $this->product->delete();
        $this->refreshContent(Lang::get('product.alert.success.delete'), 'modal-delete-product');
    }

    public function refreshContent($message, $modal) {
        //Close the active modal
		$this->dispatch('cancel', $modal);
        session()->flash('message', $message);
        $this->clearFields();
        $refresh;
    }

    public function initData(Product $product) {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->variant = implode(",", json_decode($product->variant ?? "[]"));
        $this->price = $product->price;
        $this->category_id = $product->category_id;
    }

    public function clearFields()
	{
		$this->reset([
            'name', 
            'slug', 
            'description', 
            'variant', 
            'price', 
            'image', 
            'category_id',
            'product_id',
        ]);
	}
}
