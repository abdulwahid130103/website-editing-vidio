<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('frontend/image/siwadul_logo.png') }}" height="40px" width="40px" alt="...">
            Editing</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SF</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu == 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('admin/dashboard') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('dashboard.index') }}">Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu == 'master' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('admin/role') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('role.index') }}">Role</a>
                    </li>
                    <li class='{{ Request::is('admin/kategori') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                    <li class='{{ Request::is('admin/playlist') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('playlist.index') }}">Playlist</a>
                    </li>
                    <li class='{{ Request::is('admin/user') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('user.index') }}">User</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
