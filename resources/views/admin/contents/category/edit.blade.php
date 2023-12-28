<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-edit-category">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('category.modal.edit')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div
                    class="input-group input-group-static {{ $errors->has('name') || $errors->has('slug') ? 'is-invalid' : 'mb-2' }}">
                    <label>@lang('category.table.name')</label>
                    <input wire:model.defer="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror
                @error('slug')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="edit" class="btn bg-gradient-success">@lang('category.button.edit')</button>
            </div>
        </div>
    </div>
</div>

