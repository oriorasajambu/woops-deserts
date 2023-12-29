<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-create-invoice">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('invoice.modal.add')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="row">
                    <div class="col">
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
                    </div>
                    <div class="col">
                        @foreach($carts as $cart)
                        <div class="row mt-3 align-items-center">
                            <div class="col-2">
                                <img src="{{ asset($cart->associatedModel->original) }}" style="width: 75px;height: 75px;" />
                            </div>
                            <div class="col-6">
                                <h5 class="font-weight-bolder mb-0 pb-0">{{ $cart->name }} X{{ $cart->quantity }}</h5>
                                <div class="text-xs font-weight-bold mb-0 mt-1 d-flex flex-column">
                                    <div class="form-check p-0">
                                        @foreach (json_decode($cart->associatedModel->variant) as $key => $item)
                                            <input type="radio" name="{{ $cart->associatedModel->slug }}-variant" id="{{ $cart->associatedModel->slug }}-{{ $item }}" {{ $cart->attributes->variant == $item ? 'checked' : '' }} wire:click="onClickVariant({{$cart->id}},'{{ $item }}')" value="{{ $item }}">
                                            <label class="custom-control-label font-weight-bolder" for="{{ $cart->associatedModel->slug }}-{{ $item }}">{{ $item }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="row mb-0">
                                    <h6>@lang('currency.in_ID') {{ number_format($cart->price * $cart->quantity, 2) }}</h4>
                                    <div class="col mx-auto">
                                        <button type="button" class="btn btn-icon btn-2 btn-primary btn-sm" {{ $cart->quantity == 1 ? 'disabled' : '' }} wire:click="decrementQuantity({{$cart->id}})">
                                            <span class="btn-inner--icon"><i class="fa-solid fa-minus"></i></span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-2 btn-primary btn-sm" wire:click="incrementQuantity({{$cart->id}})">
                                            <span class="btn-inner--icon"><i class="fa-solid fa-plus"></i></span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-2 btn-danger btn-sm" wire:click="remove({{$cart->id}})">
                                            <span class="btn-inner--icon"><i class="fa-solid fa-trash"></i></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row mt-3">
                            <div class="col-9 ">
                                <h6>Subtotal </h6>
                                <h6>Total</h6>
                            </div>
                            <div class="col-3 text-end">
                                <h6>@lang('currency.in_ID') {{ number_format($sub_total, 2) }}</h6>
                                <h6>@lang('currency.in_ID') {{ number_format($total, 2) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="store" class="btn bg-gradient-success">@lang('invoice.button.add')</button>
            </div>
        </div>
    </div>
</div>

