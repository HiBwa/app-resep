<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item  {{ Request::is('dashboard/resep-kategori*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kategori.index') }}">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Kategori Masakan</span>
            </a>
        </li>
        <li class="nav-item  {{ Request::is('dashboard/resep-masakan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('resep.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Resep</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
    </ul>
</nav>
