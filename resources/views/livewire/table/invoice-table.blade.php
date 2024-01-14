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
    @include('admin.contents.invoices.create')
    <!-- Edit Modal -->
    @include('admin.contents.invoices.edit')
    <!-- Delete Modal -->
    @include('admin.contents.invoices.delete')    
    <!-- Detail Modal -->
    @include('admin.contents.invoices.detail')
    <!-- Select Product Modal -->
    @include('admin.contents.invoices.select-product')
    <!-- Upload Receipt Modal -->
    @include('admin.contents.invoices.upload')
    <!-- Upload Confrim Modal -->
    @include('admin.contents.invoices.confirm')

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
                        @lang('invoice.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.info')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.location')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.company')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.canceled_by')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('invoice.table.action')
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tempData as $invoice)
                    <tr>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs text-center">#{{ sprintf('%07d', $invoice->id) }}</h6>
                                @switch($invoice->status)
                                    @case("paid")
                                        <span class="badge bg-gradient-success">{{ $invoice->status }}</span>
                                        @break
                                    @case("uploaded")
                                        <span class="badge bg-gradient-warning">{{ $invoice->status }}</span>
                                        @break
                                    @case("pending")
                                        <span class="badge bg-gradient-info">{{ $invoice->status }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-gradient-danger">{{ $invoice->status }}</span>
                                @endswitch
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-xs">{{ $invoice->first_name }} {{ $invoice->last_name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ $invoice->email }}</p>
                                <p class="text-xs text-secondary mb-0">{{ $invoice->phone }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">
                                    {{ $invoice->country }}, 
                                    {{ $invoice->province }}, 
                                    {{ $invoice->city }}, 
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $invoice->address }}, 
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    {{ $invoice->postal_code }}
                                </p>
                            </div>
                        </td>
                        <td>{{ $invoice->company ?? '-'  }}</td>
                        <td>
                            <div class="d-flex flex-column justify-content-center">
                                <p class="text-xs text-secondary mb-0">
                                    Sub Total @lang('currency.in_ID') {{ number_format($invoice->sub_total, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Pajak @lang('currency.in_ID') {{ number_format($invoice->tax, 2) }},
                                </p>
                                <p class="text-xs text-secondary mb-0">
                                    Total @lang('currency.in_ID') {{ number_format($invoice->total, 2) }}
                                </p>
                            </div>  
                        </td>
                        <td>
                            {{ $invoice->canceled_by == 'none' ? '-' :  $invoice->canceled_by }}
                        </td>
                        <td class="d-flex flex-column justify-content-center gap-2">
                            @switch($invoice->status)
                                @case("paid")
                                    @break
                                @case("uploaded")
                                    <button wire:click="initData({{ $invoice->id }})" data-bs-toggle="modal" data-bs-target="#modal-confirm-invoice" 
                                        class="btn btn-sm btn-success" type="button">
                                        Konfirmasi
                                    </button>
                                    <button wire:click="updateToPending({{ $invoice->id }})" class="btn btn-sm btn-warning" type="button">
                                        Pending
                                    </button>
                                    @break
                                @case("pending")
                                    <button wire:click="initData({{ $invoice->id }})" data-bs-toggle="modal" data-bs-target="#modal-upload-invoice"
                                        class="btn btn-sm btn-success" type="button">
                                        Upload
                                    </button>
                                    <button wire:click="updateToCanceled({{ $invoice->id }})" class="btn btn-sm btn-danger" type="button">
                                        Batalkan
                                    </button>
                                    @break
                                @case("canceled")
                                    @if ($invoice->canceled_by == 'admin')
                                        <button wire:click="updateToPending({{ $invoice->id }})" class="btn btn-sm btn-success" type="button">
                                            Pending
                                        </button>
                                    @endif
                                    @break
                            @endswitch
                            <a href="{{ route('invoices.download', $invoice->id) }}" target="_blank" class="btn btn-sm btn-info" type="button">
                                Unduh Faktur
                            </a>
                            @if ($invoice->status == "paid")
                                <button wire:click="initData({{ $invoice->id }})" data-bs-toggle="modal" data-bs-target="#modal-delete-invoice" class="btn btn-sm btn-primary" type="button">
                                    Hapus
                                </button>
                            @endif
                            @if ($invoice->status == "uploaded")
                                <button wire:click="initData({{ $invoice->id }})" data-bs-toggle="modal" data-bs-target="#modal-detail-invoice" class="btn btn-sm btn-info" type="button">
                                    Detail
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No invoices found...</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.id')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.info')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.location')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.company')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.price')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7">
                        @lang('invoice.table.canceled_by')
                    </th>
                    <th class="text-secondary text-xxs px-2 opacity-7 text-center">
                        @lang('invoice.table.action')
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex flex-row justify-content-center pt-3">
        {{$tempData->links()}}
    </div>
</div>