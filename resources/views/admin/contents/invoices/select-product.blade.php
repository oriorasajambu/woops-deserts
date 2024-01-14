<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-select-product-invoice" 
    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-3">
                            @livewire('checkbox.product-check-box', ['product' => $item])
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button data-bs-toggle="modal" data-bs-target="#modal-create-invoice" class="btn bg-gradient-danger">@lang('invoice.button.next')</button>
            </div>
        </div>
    </div>
</div>
