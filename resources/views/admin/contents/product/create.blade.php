<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-create-product">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="modal-create-product" class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('product.modal.add')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="input-group input-group-static mb-4">
                    <label for="category" class="ms-0">@lang('product.table.category')</label>
                    <select wire:model.defer="category_id" class="form-control" id="category" name="category">
                        <option value="" selected>@lang('product.category')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror

                <div
                    class="input-group input-group-static {{ $errors->has('name') || $errors->has('slug') ? 'is-invalid' : 'mb-2' }}">
                    <label>@lang('product.table.name')</label>
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

                <div
                    class="input-group input-group-dynamic {{ $errors->has('description') ? 'is-invalid' : 'mb-2' }}">
                    <textarea wire:model.defer="description" name="description" class="form-control" rows="5" placeholder="@lang('product.table.description')" spellcheck="false">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror

                <div
                    class="input-group input-group-static {{ $errors->has('variant') ? 'is-invalid' : 'mb-2' }}">
                    <label>@lang('product.table.variant')</label>
                    <input wire:model.defer="variant" type="text" class="form-control" name="variant" value="{{ old('variant') }}">
                </div>

                <div class="input-group input-group-static {{ $errors->has('price') ? 'is-invalid' : 'mb-2' }}">
                    <label>@lang('product.table.price')</label>
                    <input wire:model.defer="price" type="text" class="form-control" name="price" value="{{ old('price') }}">
                </div>
                @error('price')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror

                <input required multiple wire:model="image" type="file" name="image" accept="image/png,image/gif,image/jpeg"
                    class="{{ $errors->has('image') ? 'is-invalid' : '' }} w-100" aria-describedby="image">
                @error('image.*')
                    <div class="invalid-feedback text-xs mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="store" class="btn bg-gradient-success">@lang('product.button.add')</button>
            </div>
        </div>
    </div>
</div>
