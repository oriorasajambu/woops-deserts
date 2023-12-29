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

        <!-- Create Modal -->
        @include('admin.contents.order.create')
        <!-- Edit Modal -->
        @include('admin.contents.order.edit')
        <!-- Delete Modal -->
        @include('admin.contents.order.delete')        
        <!-- Detail Modal -->
        @include('admin.contents.order.detail')

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
                            @lang('order.table.id')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.info')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.orders')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.price')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                            @lang('order.table.action')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tempData as $order)
                        <tr>
                            <td>
                                <div class="d-flex flex-row">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-xs text-center">#{{ sprintf('%07d', $order->id) }}</h6>
                                        @switch($order->status)
                                            @case("finish")
                                                <span class="badge bg-gradient-success">{{ $order->status }}</span>
                                                @break
                                            @case("inprogress")
                                                <span class="badge bg-gradient-warning">{{ $order->status }}</span>
                                                @break
                                            @case("pending")
                                                <span class="badge bg-gradient-info">{{ $order->status }}</span>
                                                @break
                                            @default
                                                <span class="badge bg-gradient-danger">{{ $order->status }}</span>
                                        @endswitch
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">{{ $order->invoice->first_name }} {{ $order->invoice->last_name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $order->invoice->email }}</p>
                                    <p class="text-xs text-secondary mb-0">{{ $order->invoice->phone }}</p>
                                </div>
                            </td>
                            <td >
                                <div class="d-flex flex-row align-items-center">
                                    @foreach ((array) json_decode($order->invoice->orders) as $item)
                                        <div>
                                            <h6 class="mb-0 text-xs text-center">{{ $item->name }}</h6>
                                            <span class="badge bg-gradient-success">{{ $item->attributes->variant }}</span>
                                            <p class="text-xs text-secondary mt-1 text-center mb-0">Quantity <b>X{{ $item->quantity }}</b> </p>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column justify-content-center">
                                    <p class="text-xs text-secondary mb-0">
                                        Sub Total @lang('currency.in_ID') {{ number_format($order->invoice->sub_total, 2) }},
                                    </p>
                                    <p class="text-xs text-secondary mb-0">
                                        Tax @lang('currency.in_ID') {{ number_format($order->invoice->tax, 2) }},
                                    </p>
                                    <p class="text-xs text-secondary mb-0">
                                        Total @lang('currency.in_ID') {{ number_format($order->invoice->total, 2) }}
                                    </p>
                                </div>  
                            </td>
                            <td class="d-flex flex-row justify-content-center align-items-center gap-2 my-auto">
                                <div class="d-flex flex-column justify-content-center align-items-center my-auto">
                                    @switch($order->status)
                                        @case("finish")
                                            <a href="{{ route('receipt.download', $order->payment_id) }}" target="_blank" class="btn btn-icon btn-sm btn-info m-0" type="button">
                                                <span class="btn-inner--icon"><i class="fa-solid fa-download"></i></span>
                                            </a>
                                            @break
                                        @case("inprogress")
                                            <button wire:click="updateToFinish({{ $order->id }})" class="btn btn-icon btn-sm btn-success m-0" type="button">
                                                <span class="btn-inner--icon"><i class="fa-solid fa-check"></i></span>
                                            </button>
                                            @break
                                        @case("pending")
                                            @break
                                        @default
                                            <button wire:click="updateToPending({{ $order->id }})" class="btn btn-icon btn-sm btn-success m-0" type="button">
                                                <span class="btn-inner--icon"><i class="fa-solid fa-check"></i></span>
                                            </button>
                                    @endswitch
                                    
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <button wire:click="initData({{ $order->id }})" data-bs-toggle="modal" data-bs-target="#modal-delete-order" class="btn btn-icon btn-sm btn-primary m-0" type="button">
                                        <span class="btn-inner--icon"><i class="fa-solid fa-trash"></i></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found...</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.id')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.info')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.orders')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7">
                            @lang('order.table.price')
                        </th>
                        <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                            @lang('order.table.action')
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="d-flex flex-row justify-content-center pt-3">
            {{$tempData->links()}}
        </div>
    </div>
</div>