<div class="col-lg-6 my-6">
    @foreach($carts as $cart)
        <div class="row mt-3 align-items-center">
            <div class="col-2">
                <img src="{{ asset(json_decode($cart->associatedModel->original)[0]) }}" style="width: 75px;height: 75px;" />
            </div>
            <div class="col-6">
                <h5 class="font-weight-bolder mb-0 pb-0">{{ $cart->name }} X{{ $cart->quantity }}</h5>
                <p class="my-0 py-0">{{ $cart->associatedModel->description }}</p>
                <div class="text-xs font-weight-bold mb-0 mt-1 d-flex flex-column">
                    <div class="form-check p-0">
                        @foreach (json_decode($cart->associatedModel->variant) as $key => $item)
                            <input required type="radio" name="{{ $cart->associatedModel->slug }}-variant" id="{{ $cart->associatedModel->slug }}-{{ $item }}" {{ $cart->attributes->variant == $item ? 'checked' : '' }} wire:click="onClickVariant({{$cart->id}},'{{ $item }}')" value="{{ $item }}">
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
        <input type="hidden" name="orders" value="{{$orders}}">
        <input type="hidden" name="sub_total" value="{{$subTotal}}">
        <input type="hidden" name="tax" value="{{($subTotalWithTax - $subTotal)}}">
        <input type="hidden" name="total" value="{{$subTotalWithTax}}">
        <div class="col-9 ">
            <h6>Subtotal</h6>
            <h6>Perkiraan Pajak</h6>
            <h6>Total</h6>
        </div>
        <div class="col-3 text-end">
            <h6>@lang('currency.in_ID') {{ number_format($subTotal, 2) }}</h6>
            <h6>@lang('currency.in_ID') {{ number_format($subTotalWithTax - $subTotal, 2) }}</h6>
            <h6>@lang('currency.in_ID') {{ number_format($subTotalWithTax, 2) }}</h6>
        </div>
    </div>
</div>