
<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white " style="width: 280px;min-height:100%">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <span class="fs-4 text-white">Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto text-white">
    
    <li>
        <a href="/admin" class="nav-link text-white {{ Route::currentRouteNamed('dashboard-admin') ? 'active' : '' }} link-body-emphasis">
            <i class="bi bi-speedometer2 pe-none me-2"></i>
        Dashboard
        </a>
    </li>
    <li>
        <a href="/admin/order" class="nav-link text-white {{ Route::currentRouteNamed('order-admin') ? 'active' : '' }} link-body-emphasis">
            <i class="bi bi-table pe-none me-2"></i>
        Orders
        </a>
    </li>
    <li>
        <div class="nav-link link-body-emphasis text-white d-inline-flex align-items-center border-0 w-100" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false" style="cursor: pointer">
            <span><i class="bi bi-grid pe-none me-2"></i></span>
            Products
        </div>
        <div class="collapse" id="home-collapse">
            <ul class="nav nav-pills flex-column mb-auto list-unstyled fw-normal pb-1 small" style="padding: 0.2rem 0.5rem; margin-top: 0.2rem; margin-left: 1.25rem">
                <li><a href="/admin/product" class="nav-link {{ Request::is('/admin/product') ? 'active' : '' }} text-white">Product</a></li>
                <li><a href="/admin/category" class="nav-link  text-white">Category</a></li>
                
            </ul>
        </div>

        {{-- <a href="/admin/product" class="nav-link text-white {{ Route::currentRouteNamed('product-admin') ? 'active' : '' }} link-body-emphasis">
            <i class="bi bi-grid pe-none me-2"></i>
        Products
        </a> --}}
      



    </li>
    <li>
        <a href="/admin/user" class="nav-link text-white {{ Route::currentRouteNamed('user-admin') ? 'active' : '' }} link-body-emphasis">
            <i class="bi bi-person-circle pe-none me-2"></i>
        User
        </a>
    </li>
    <li>
        <a href="/admin/reports" class="nav-link text-white {{ Route::currentRouteNamed('reports-admin') ? 'active' : '' }} link-body-emphasis">
            <i class="bi bi-graph-up pe-none me-2"></i>
        Reports
        </a>
    </li>
    </ul>
    <hr>
    <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
    </a>
    <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
    </ul>
    </div>
</div>

