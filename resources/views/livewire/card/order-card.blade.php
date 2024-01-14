<div class="min-vh-65 container d-flex align-items-center justify-content-center">

    @include('public.contents.orders.cancel')
    @include('public.contents.orders.upload')

    <div class="card w-100">
        <div class="table-responsive">
            <table class="table align-items-center mb-0" id="example" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Invoice ID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Orders</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    @if ($order->invoice->status != 'canceled')
                        <tr>
                            <td class="mb-0 text-xs text-center">#{{ sprintf('%07d', $order->invoice->id) }}</td>
                            <td>
                                @foreach (json_decode($order->invoice->orders) as $item)
                                    <div class="d-flex px-2 py-1">
                                        <div class="align-self-center">
                                            <img src="{{ asset(json_decode($item->associatedModel->original)[0]) }}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $item->name }}</h6>
                                            <span class="badge bg-gradient-success text-white text-xxs">{{ $item->attributes->variant }}</span>
                                            <p class="text-xs text-secondary mb-0">Quantity <b>X{{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @switch($order->invoice->status)
                                    @case("paid")
                                        <span class="badge bg-gradient-success text-white text-xxs">{{ $order->invoice->status }}</span>
                                        @break
                                    @case("uploaded")
                                        <span class="badge bg-gradient-warning text-white text-xxs">{{ $order->invoice->status }}</span>
                                        @break
                                    @case("pending")
                                        <span class="badge bg-gradient-info text-white text-xxs">{{ $order->invoice->status }}</span>
                                        @break
                                    @default
                                        <span class="badge bg-gradient-danger text-white text-xxs">{{ $order->invoice->status }}</span>
                                @endswitch
                            </td>
                            <td>
                                <div class="d-flex flex-column align-self-center px-2 py-1">
                                    <div class="d-flex align-self-center gap-2">
                                        @switch($order->invoice->status)
                                            @case("paid")
                                                <a href="{{ route('receipt.download', $order->payment->id) }}" target="_blank" class="btn btn-icon btn-sm btn-info" type="button">
                                                    <span class="btn-inner--icon"><i class="fa-solid fa-download"></i></span>
                                                </a>
                                                @break
                                            @case("uploaded")
                                                @break
                                            @case("pending")
                                                <a href="{{ route('invoices.download', $order->invoice->id) }}" target="_blank" class="btn btn-sm btn-info my-0" type="button">
                                                    Unduh Faktur
                                                </a>
                                                <button wire:click="initData({{ $order->invoice->id }},{{ $order->id }})" data-bs-toggle="modal" data-bs-target="#modal-upload-payment" class="btn btn-sm btn-success my-0" type="button">
                                                    Upload Bukti Pembayaran
                                                </button>
                                                <button wire:click="initData({{ $order->invoice->id }},{{ $order->id }})" data-bs-toggle="modal" data-bs-target="#modal-cancel-order" class="btn btn-sm btn-danger my-0" type="button">
                                                    Batalkan
                                                </button>
                                                @break
                                            @case("canceled")
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>