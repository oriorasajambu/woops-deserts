<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-edit-invoice">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('invoice.modal.edit')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('email') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="email">Email</label>
                            <input wire:model.defer="email" type="email" class="form-control" name="email" id="email">
                        </div>
                        @error('email')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('country') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="country">Country/Region</label>
                            <input wire:model.defer="country" type="text" class="form-control" name="country" id="country">
                        </div>
                        @error('country')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('first_name') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="first_name">First Name</label>
                            <input wire:model.defer="first_name" type="text" class="form-control" name="first_name" id="first_name">
                        </div>
                        @error('first_name')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('last_name') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input wire:model.defer="last_name" type="text" class="form-control" name="last_name" id="last_name">
                        </div>
                        @error('last_name')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('company') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="country">Company(Optional)</label>
                            <input wire:model.defer="company" type="text" class="form-control" name="company" id="company">
                        </div>
                        @error('company')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('address') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="address">Address</label>
                            <input wire:model.defer="address" type="text" class="form-control" name="address" id="address">
                        </div>
                        @error('address')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('city') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="city">City</label>
                            <input wire:model.defer="city" type="text" class="form-control" name="city" id="city">
                        </div>
                        @error('city')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('province') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="province">Province</label>
                            <input wire:model.defer="province" type="text" class="form-control" name="province" id="province">
                        </div>
                        @error('province')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('postal_code') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="postal_code">Postal Code</label>
                            <input wire:model.defer="postal_code" type="text" class="form-control" name="postal_code" id="postal_code">
                        </div>
                        @error('postal_code')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('phone') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="phone">Phone</label>
                            <input wire:model.defer="phone" type="text" class="form-control" name="phone" id="phone">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('sub_total') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="sub_total">Sub Total</label>
                            <input wire:model.defer="sub_total" type="text" class="form-control" name="sub_total" id="sub_total">
                        </div>
                        @error('sub_total')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('tax') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="tax">Tax</label>
                            <input wire:model.defer="tax" type="text" class="form-control" name="tax" id="tax">
                        </div>
                        @error('tax')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="input-group input-group-outline my-3 {{ $errors->has('total') ? 'is-invalid' : 'mb-2' }}">
                            <label class="form-label" for="total">Total</label>
                            <input wire:model.defer="total" type="text" class="form-control" name="total" id="total">
                        </div>
                        @error('total')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="edit" class="btn bg-gradient-success">@lang('invoice.button.edit')</button>
            </div>
        </div>
    </div>
</div>

