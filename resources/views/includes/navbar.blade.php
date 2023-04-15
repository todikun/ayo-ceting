<div class="d-flex align-items-center justify-content-between">
    <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">AyoCeting</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->



<nav class="header-nav ms-auto pe-3">
    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <span class="d-none d-md-block dropdown-toggle ps-2" id="user-logged" title="Administrator"></span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

        <li>
            <a class="dropdown-item d-flex align-items-center" href="#" onclick="event.preventDefault();
				document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </a>
        </li>

        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
            @csrf
        </form>

    </ul>
</nav>
<!-- End Icons Navigation -->