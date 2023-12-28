<?php

namespace App\Livewire\Table;

use App\Models\Config;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ConfigTable extends Component
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
	public ?string $value = null;
    public ?Config $config = null;

    //Update & Store Rules
	protected array $rules = [
        'name'  => 'bail|required|min:3',
        'slug'  => 'unique:configs,slug',
        'value' => 'bail|required|min:3',
    ];

    public function render()
    {
        $tempData = Config::search($this->query)
            ->orderBy($this->orderBy, $this->orderAsc)
            ->paginate($this->perPage);

        return view('livewire.table.config-table', compact('tempData'));
    }

    public function store()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            Config::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'value' => $this->value,
            ]);
		});

        $this->refreshContent(Lang::get('config.alert.success.create'), 'modal-create-config');
    }

    public function edit()
	{
        $this->slug = Str::slug($this->name);
		$this->validate();

        DB::transaction(function () {
            $this->config->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'value' => $this->value,
            ]);
		});

        $this->refreshContent(Lang::get('config.alert.success.edit'), 'modal-edit-config');
    }

    public function delete()
	{
        DB::transaction(function () {
            $this->config->delete();
		});

        $this->refreshContent(Lang::get('config.alert.success.delete'), 'modal-delete-config');
    }

    public function search()
    {
        $this->resetPage();
    }

    public function applyFilter() 
    {
        $this->resetPage();
    }

    public function initData(Config $config) {
        $this->config = $config;
        $this->name = $config->name;
        $this->slug = $config->slug;
        $this->value = $config->value;
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
