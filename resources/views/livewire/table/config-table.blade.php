<div class="table-responsive p-0 px-6">
    <div class="d-flex flex-column">
        @if (session()->has('message'))
            <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                <span class="alert-text">{{ session('message') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <!-- Create Modal -->
    @include('admin.contents.config.create')
    <!-- Edit Modal -->
    @include('admin.contents.config.edit')
    <!-- Delete Modal -->
    @include('admin.contents.config.delete')

    <div class="d-flex flex-row">
        <div class="input-group input-group-dynamic">
            <input class="form-control" wire:model="query" wire:keydown.enter="search()" placeholder="Search" id="search" type="text" aria-label="search" aria-describedby="search">
        </div>
        <div class="input-group input-group-static">
            <label for="orderBy" class="ms-0">@lang('common.order_by.title')</label>
            <select class="form-control" wire:model="orderBy" id="orderBy">
                <option value="id">@lang('common.order_by.id')</option>
                <option value="status">@lang('common.order_by.status')</option>
                <option value="created_at">@lang('common.order_by.created_at')</option>
            </select>
        </div>
        <div class="input-group input-group-static">
            <label for="direction" class="ms-0">@lang('common.order_direction.title')</label>
            <select class="form-control" wire:model="orderAsc" id="direction">
                <option value="asc">@lang('common.order_direction.asc')</option>
                <option value="desc">@lang('common.order_direction.desc')</option>
            </select>
        </div>
        <div class="input-group input-group-static">
            <label for="perPage" class="ms-0">@lang('common.pagination_page.title')</label>
            <select class="form-control" wire:model="perPage" id="perPage">
                <option value="10">@lang('common.pagination_page.val_1')</option>
                <option value="20">@lang('common.pagination_page.val_2')</option>
                <option value="30">@lang('common.pagination_page.val_3')</option>
                <option value="40">@lang('common.pagination_page.val_4')</option>
                <option value="50">@lang('common.pagination_page.val_5')</option>
            </select>
        </div>
        <button class="btn btn-icon btn-primary" type="button" wire:click="applyFilter()">
            <span class="btn-inner--icon mx-auto px-0 text-center"><i class="fa-brands fa-searchengin"></i></span>
        </button>
    </div>

    <div class="d-flex flex-row justify-content-center pt-3">
        {{$tempData->links()}}
    </div>

    <div class="d-flex flex-row justify-content-center">
        <table class="table align-items-center mb-0" id="example" style="width:100%">
            <thead>
                <tr>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.name')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.value')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('config.table.action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tempData as $config)
                    <tr>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">#{{ sprintf('%07d', $config->id) }}</h6>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">{{ $config->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $config->slug }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">
                                    Sub Total @lang('currency.in_ID') {{ number_format($config->sub_total, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Tax @lang('currency.in_ID') {{ number_format($config->tax, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Total @lang('currency.in_ID') {{ number_format($config->total, 2) }}
                                </p>
                            </div>  
                        </td>
                        <td class="d-flex flex-row justify-content-center gap-2">
                            <div class="d-flex flex-column justify-content-center">
                                <button wire:click="delete({{ $config->id }})" class="btn btn-icon btn-sm btn-primary" type="button">
                                    <span class="btn-inner--icon"><i class="fa-solid fa-trash"></i></span>
                                </button>
                                <button wire:click="detail({{ $config->id }})" class="btn btn-icon btn-sm btn-info" type="button">
                                    <span class="btn-inner--icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </button>
                                <button wire:click="edit({{ $config->id }})" class="btn btn-icon btn-sm btn-warning" type="button">
                                    <span class="btn-inner--icon"><i class="fa-solid fa-pen-to-square"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No configs found...</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.name')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('config.table.value')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('config.table.action')
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex flex-row justify-content-center pt-3">
        {{$tempData->links()}}
    </div>
</div>