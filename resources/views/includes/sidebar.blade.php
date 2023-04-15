<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link {{Route::is('dashboard') ? '':'collapsed'}}" href="{{route('dashboard')}}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{Route::is('edukasi.*') ? '':'collapsed'}}" data-bs-target="#forms-nav"
            data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Edukasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse {{Route::is('edukasi.*') ? 'show':''}}"
            data-bs-parent="#sidebar-nav">
            <li>
                <a class="{{Route::is('edukasi.*') ? 'active':''}}" href="{{route('edukasi.index')}}">
                    <i class="bi bi-circle"></i><span>Edukasi</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-layout-text-window-reverse"></i><span>Laporan</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="#">
                    <i class="bi bi-circle"></i><span>Laporan 1</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bi bi-circle"></i><span>Laporan 2</span>
                </a>
            </li>
        </ul>
    </li><!-- End Tables Nav -->

</ul>