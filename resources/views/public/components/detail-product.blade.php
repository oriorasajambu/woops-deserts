<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-detail-product">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div id="modal-create-product" class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($product)
                <div id="modal-body-form" class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <!-- slider container -->
                            <div class="slider">
                                <div class="slide">
                                    <img src="{{ asset($image) }}" alt="" class="w-100 img-fluid" />
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4>{{ $product->name }}</h4>
                            <p class="text-xs text-white font-weight-bold">
                                @foreach (json_decode($product->variant) as $item)
                                    <span class="badge bg-gradient-info text-white">{{ $item }}</span>
                                @endforeach
                            </p>
                            <p>{{ $product->description }}</p>
                            <h4>@lang('currency.in_ID') {{ number_format($product->price, 2) }}</h4>
                            @if (count($images) > 1)
                                <div>
                                    <button class="btn btn-success" type="button" wire:click="prevSlide">
                                        Sebelumnya
                                    </button>
                                    <button class="btn btn-success" type="button" wire:click="nextSlide">
                                        Selanjutnya
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">
                        @lang('common.cancel')
                    </button>
                    @if (Cart::session($sessionId)->get($id))
                        <button data-bs-dismiss="modal" wire:click.prevent="remove" class="btn bg-gradient-danger">
                            Hapus dari Keranjang
                        </button>
                    @else
                        <button data-bs-dismiss="modal" wire:click.prevent="add" class="btn bg-gradient-success">
                            Tambahkan ke Keranjang
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
