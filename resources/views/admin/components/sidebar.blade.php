<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-light"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('admin') }}">
            <img src="{{ url('assets/public/img/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-dark">Woop's Dessert</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ $page == 'dashboard' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('admin') }}">
                    <div class="{{ $page == 'dashboard' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.dashboard')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'categories' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('category.index') }}">
                    <div class="{{ $page == 'categories' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.categories')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'products' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('product.index') }}">
                    <div class="{{ $page == 'products' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.products')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'postage_cost' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('postage-cost.index') }}">
                    <div class="{{ $page == 'postage_cost' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">notifications</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.postage_cost')</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">@lang('sidebar.report.title')</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'expense' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('expense.index') }}">
                    <div class="{{ $page == 'expense' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.report.expense')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'sales' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('sales.index') }}">
                    <div class="{{ $page == 'sales' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.report.sales')</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">@lang('sidebar.billing.title')</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'order' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('order.index') }}">
                    <div class="{{ $page == 'order' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.billing.order')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'payment' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('payment.index') }}">
                    <div class="{{ $page == 'payment' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">login</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.billing.payment')</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $page == 'invoices' ? 'text-white active bg-gradient-primary' : 'text-dark' }}" href="{{ route('invoices.index') }}">
                    <div class="{{ $page == 'invoices' ? 'text-white' : 'text-dark' }} text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment</i>
                    </div>
                    <span class="nav-link-text ms-1">@lang('sidebar.billing.invoices')</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
