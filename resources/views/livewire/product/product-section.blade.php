<div>
    @include('public.components.detail-product')

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-3">
        <section>    
            @foreach ($categories as $category)
                <div class="row" id="{{ $category->slug }}">
                    <h1>{{ $category->name }}</h1>
                    @foreach ($category->products as $product)
                        <div class="col-3 mt-4">
                            <div class="card card-rotate card-background"
                                style="background-image: url({{ asset(json_decode($product->original)[0]) }}); background-size: cover;">
                                <div class="card-body py-7 text-center">
                                    <h3 class="text-white">
                                        {{ $product->name }}
                                    </h3>
                                    <button wire:click="initData({{ $product }})" data-bs-toggle="modal" data-bs-target="#modal-detail-product" class="btn btn-white btn-sm mt-3">
                                        Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </section>
    </div>
</div>