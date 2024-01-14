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
    @include('admin.contents.product.create')
    <!-- Edit Modal -->
    @include('admin.contents.product.edit')
    <!-- Delete Modal -->
    @include('admin.contents.product.delete')

    <div class="d-flex flex-row">
        <div class="input-group input-group-dynamic">
            <input class="form-control" wire:model="query" wire:keydown.enter="search()" placeholder="Search" id="search" type="text" aria-label="search" aria-describedby="search">
        </div>
        <div class="input-group input-group-static">
            <label for="orderBy" class="ms-0">@lang('common.order_by.title')</label>
            <select class="form-control" wire:model="orderBy" id="orderBy">
                <option value="id">@lang('common.order_by.id')</option>
                <option value="slug">@lang('common.order_by.slug')</option>
                <option value="name">@lang('common.order_by.name')</option>
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
                        @lang('product.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.name')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 w-25">
                        @lang('product.table.description')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.variant')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.image')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.category')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.created_by')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tempData as $product)
                    <tr>
                        <td>
                            <div class="d-flex flex-column">
                                <h6 class="mb-0 text-xs">#{{ sprintf('%07d', $product->id) }}</h6>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <h6 class="mb-0 text-xs">{{ $product->name }}</h6>
                                <p class="text-xs font-weight-bold mb-0">{{ $product->slug }}</p>
                            </div>
                        </td>
                        <td style="word-wrap: break-word">
                            <div class="d-flex flex-column" style="width: 300px;word-wrap: break-word">
                                <p class="text-xs text-truncate font-weight-bold mb-0" style="word-wrap: break-word">{{ $product->description }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <p class="text-xs font-weight-bold mb-0">
                                    @foreach (json_decode($product->variant) as $item)
                                        <span class="badge bg-gradient-info">{{ $item }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <p class="text-xs font-weight-bold mb-0">
                                    @lang('currency.in_ID') {{ number_format($product->price, 2) }}
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <img class="avatar avatar-sm me-3" src="{{ asset(json_decode($product->original)[0]) }}" />
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <p class="text-xs font-weight-bold mb-0">{{ $product->category->name ?? '-' }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <p class="text-xs font-weight-bold mb-0">{{ $product->user->name ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="d-flex align-middle gap-1">
                            <button wire:click="initData({{ $product->id }})" data-bs-toggle="modal" data-bs-target="#modal-delete-product" class="btn btn-icon btn-sm btn-primary">
                                Hapus
                            </button>
                            <button wire:click="initData({{ $product->id }})" data-bs-toggle="modal" data-bs-target="#modal-edit-product" class="btn btn-icon btn-sm btn-warning">
                                Ubah
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No products found...</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot >
                <tr>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.name')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 w-25">
                        @lang('product.table.description')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.variant')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.image')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.category')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.created_by')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('product.table.action')
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex flex-row justify-content-center pt-3">
        {{$tempData->links()}}
    </div>
</div>