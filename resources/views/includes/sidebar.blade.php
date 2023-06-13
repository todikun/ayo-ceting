<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">AYOCETING</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard')}}">**</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{Route::is('dashboard') ? 'active':''}}">
                <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Edukasi</li>
            <li class="nav-item {{Route::is('edukasi.*') ? 'active':''}}">
                <a href="{{route('edukasi.index')}}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Edukasi</span></a>
            </li>

            <li class="menu-header">Pengaduan</li>
            <li class="nav-item dropdown {{Route::is('pengaduan.*') ? 'active':''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Pengaduan</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Route::is('pengaduan.index') ? 'active':''}}"><a class="nav-link"
                            href="{{route('pengaduan.index')}}">Pengaduan</a>
                    </li>
                    <li class="{{Route::is('pengaduan.riwayat') ? 'active':''}}"><a class="nav-link"
                            href="{{route('pengaduan.riwayat')}}">Riwayat Pengaduan</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Konsultasi</li>
            <li class="nav-item dropdown {{Route::is('konsultasi.*') ? 'active':''}}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Konsultasi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{Route::is(['konsultasi.index', 'konsultasi.message']) ? 'active':''}}"><a
                            class="nav-link" href="{{route('konsultasi.index')}}">Konsultasi</a>
                    </li>
                    <li class="{{Route::is(['konsultasi.riwayat', 'konsultasi.riwayat.detail']) ? 'active':''}}"><a class="nav-link"
                            href="{{route('konsultasi.riwayat')}}">Riwayat Konsultasi</a>
                    </li>
                </ul>
            </li>

        </ul>
    </aside>
</div>