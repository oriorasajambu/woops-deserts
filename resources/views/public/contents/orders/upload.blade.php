<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-upload-payment">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('order.modal.upload')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="align-self-center">
                        <img src="{{ asset('assets/public/img/logo_bca.png') }}" class="avatar avatar-xxl me-3">
                    </div>
                    </div>
                    <h3 class="text-center">Make Payment Via BCA</h3>
                    <h4 class="text-center">6475228867</h4>
                    <p class="text-center">A.N Rio Wirawan</p>
                    <p class="text-center">@lang('currency.in_ID') {{ $total }}</p>
                </div>
                <input wire:model="image" type="file" name="image" accept="image/png,image/gif,image/jpeg"
                    class="{{ $errors->has('image') ? 'is-invalid' : '' }} w-100" aria-describedby="image">
                @error('image')
                    <div class="invalid-feedback text-xs mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="uploadPayment" class="btn bg-gradient-success">@lang('order.button.upload')</button>
            </div>
        </div>
    </div>
</div>
