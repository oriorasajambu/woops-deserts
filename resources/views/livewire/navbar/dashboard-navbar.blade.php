<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav
                class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3 text-primary" href="/">
                        <img src="{{ url('assets/public/img/logo.png') }}" style="width: 25px; height: 25px;"
                            alt="main_logo">
                        Woop's Dessert Bar
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">

                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuPages"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md">layers</i>
                                    Kategori
                                    <img src="{{ url('assets/public/img/down-arrow-dark.svg') }}" alt="down-arrow"
                                        class="arrow ms-auto ms-md-2">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                    aria-labelledby="dropdownMenuPages">
                                    <div class="d-none d-lg-block">
                                        @foreach ($categories as $category)
                                            <a href="#{{ $category->slug }}"
                                                class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                                {{ $category->name }}
                                                </h6>
                                                @foreach ($category->products as $product)
                                                    <a href="#{{ $product->slug }}"
                                                        class="dropdown-item border-radius-md">
                                                        <span>{{ $product->name }}</span>
                                                    </a>
                                                @endforeach
                                        @endforeach
                                    </div>

                                    <div class="d-lg-none">
                                        @foreach ($categories as $category)
                                            <a href="#{{ $category->slug }}"
                                                class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">
                                                {{ $category->name }}
                                            </a>
                                            @foreach ($category->products as $product)
                                                <a href="#{{ $product->slug }}" class="dropdown-item border-radius-md">
                                                    <span>{{ $product->name }}</span>
                                                </a>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                            @if (!$isCartEmpty)
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center text-primary"
                                        href="{{ route('cart') }}">
                                        <i class="material-icons opacity-6 me-2 text-md">shopping_cart</i>
                                        Keranjang
                                        <span
                                            class="badge badge-sm badge-circle badge-primary">{{ $cartQuantity }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (!$isOrderEmpty)
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center text-primary"
                                        href="{{ route('customer.orders') }}">
                                        <i class="material-icons opacity-6 me-2 text-md">storefront</i>
                                        Orders
                                        <span
                                            class="badge badge-sm badge-circle badge-primary">{{ $orderQuantity }}</span>

                                    </a>
                                </li>
                            @endif

                            <li class="nav-item dropdown dropdown-hover mx-2">
                                @auth
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center text-primary"
                                        href="{{ route('admin') }}">
                                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                        Halaman Utama
                                    </a>
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center text-primary"
                                        href="{{ route('logout') }}">
                                        <i class="material-icons opacity-6 me-2 text-md">logout</i>
                                        Keluar
                                    </a>
                                @else
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center text-primary"
                                        href="{{ route('login') }}">
                                        <i class="material-icons opacity-6 me-2 text-md">login</i>
                                        Masuk
                                    </a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
