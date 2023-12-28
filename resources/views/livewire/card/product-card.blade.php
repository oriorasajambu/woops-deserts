<div class="col-3 mt-4">
    <div class="card card-rotate card-background" style="background-image: url({{asset($product->original)}}); background-size: cover;">
        <div class="card-body py-7 text-center">
            <h3 class="text-white">
                {{ $product->name }}
            </h3>
            <h4 class="text-white">
                @lang('currency.in_ID') {{ number_format($product->price, 2) }}
            </h4>
            <p class="text-white opacity-8">
                {{ $product->description }}
            </p>
            @if(Cart::session($sessionId)->get($product->id))
                <button wire:click="remove()" class="btn btn-danger btn-sm mt-3">
                    Remove to Cart
                </button>
            @else
                <button wire:click="add()" class="btn btn-white btn-sm mt-3">
                    Add to Cart
                </button>
            @endif
        </div>
    </div>
</div>