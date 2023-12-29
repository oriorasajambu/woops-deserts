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
    @include('admin.contents.payment.create')
    <!-- Edit Modal -->
    @include('admin.contents.payment.edit')
    <!-- Delete Modal -->
    @include('admin.contents.payment.delete')    
    <!-- Detail Modal -->
    @include('admin.contents.payment.detail')

    <div class="d-flex flex-row">
        <div class="input-group input-group-dynamic">
            <input class="form-control" wire:model="query" wire:keydown.enter="search()" placeholder="Search" id="search" type="text" aria-label="search" aria-describedby="search">
        </div>
        <div class="input-group input-group-static">
            <label for="orderBy" class="ms-0">@lang('common.order_by.title')</label>
            <select class="form-control" wire:model="orderBy" id="orderBy">
                <option value="payments.id">@lang('common.order_by.id')</option>
                <option value="status">@lang('common.order_by.status')</option>
                <option value="payments.created_at">@lang('common.order_by.created_at')</option>
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
                        @lang('payment.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.info')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.location')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.company')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('payment.table.action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tempData as $payment)
                    <tr>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">#{{ sprintf('%07d', $payment->id) }}</h6>
                                @switch($payment->status)
                                    @case("paid")
                                        <span class="badge bg-gradient-success">{{ $payment->status }}</span>
                                        @break
                                    @case("uploaded")
                                        <span class="badge bg-gradient-warning">{{ $payment->status }}</span>
                                        @break
                                    @case("pending")
                                        <span class="badge bg-gradient-info">{{ $payment->status }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-gradient-danger">{{ $payment->status }}</span>
                                @endswitch
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">{{ $payment->first_name }} {{ $payment->last_name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $payment->email }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $payment->phone }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $payment->country }}, 
                                    {{ $payment->province }}, 
                                    {{ $payment->city }}, 
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $payment->address }}, 
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $payment->postal_code }}
                                </p>
                            </div>
                        </td>
                        <td>{{ $payment->company ?? '-'  }}</td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">
                                    Sub Total @lang('currency.in_ID') {{ number_format($payment->sub_total, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Tax @lang('currency.in_ID') {{ number_format($payment->tax, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Total @lang('currency.in_ID') {{ number_format($payment->total, 2) }}
                                </p>
                            </div>  
                        </td>
                        <td class="d-flex flex-row justify-content-center gap-2">
                            <div class="d-flex flex-column justify-content-center">
                                <a href="{{ route('receipt.download', $payment->id) }}" target="_blank" class="btn btn-icon btn-sm btn-info" type="button">
                                    <span class="btn-inner--icon"><i class="fa-solid fa-download"></i></span>
                                </a>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <button wire:click="initData({{ $payment->id }})" data-bs-toggle="modal" data-bs-target="#modal-delete-payment" class="btn btn-icon btn-sm btn-primary" type="button">
                                    <span class="btn-inner--icon"><i class="fa-solid fa-trash"></i></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No payments found...</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.info')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.location')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.company')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('payment.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('payment.table.action')
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex flex-row justify-content-center pt-3">
        {{$tempData->links()}}
    </div>
</div>