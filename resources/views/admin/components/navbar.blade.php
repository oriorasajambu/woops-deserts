<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
                    @switch($page)
                        @case('dashboard')
                            @lang('sidebar.dashboard')
                        @break

                        @case('categories')
                            @lang('sidebar.categories')
                        @break

                        @case('products')
                            @lang('sidebar.products')
                        @break

                        @case('postage_cost')
                            @lang('sidebar.postage_cost')
                        @break

                        @case('expense')
                            @lang('sidebar.report.expense')
                        @break

                        @case('sales')
                            @lang('sidebar.report.sales')
                        @break

                        @case('order')
                            @lang('sidebar.billing.order')
                        @break

                        @case('payment')
                            @lang('sidebar.billing.payment')
                        @break

                        @case('configs')
                            @lang('sidebar.configs')
                        @break

                        @default
                            @lang('sidebar.billing.invoices')
                    @endswitch
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">
                @switch($page)
                    @case('dashboard')
                        @lang('sidebar.dashboard')
                    @break

                    @case('categories')
                        @lang('sidebar.categories')
                    @break

                    @case('products')
                        @lang('sidebar.products')
                    @break

                    @case('postage_cost')
                        @lang('sidebar.postage_cost')
                    @break

                    @case('expense')
                        @lang('sidebar.report.expense')
                    @break

                    @case('sales')
                        @lang('sidebar.report.sales')
                    @break

                    @case('order')
                        @lang('sidebar.billing.order')
                    @break

                    @case('payment')
                        @lang('sidebar.billing.payment')
                    @break

                    @case('configs')
                        @lang('sidebar.configs')
                    @break

                    @default
                        @lang('sidebar.billing.invoices')
                @endswitch
            </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="ps-2 nav-item d-flex align-items-center">
                        <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
