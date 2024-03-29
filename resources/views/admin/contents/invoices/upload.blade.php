<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-upload-invoice">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('invoice.modal.upload')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
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
                <button type="submit" wire:click.prevent="updateToUploaded" class="btn bg-gradient-danger" data-bs-dismiss="modal">@lang('invoice.button.upload')</button>
            </div>
        </div>
    </div>
</div>
