<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html">
                        <img src="{{ asset('Logo.png') }}" alt="Logo" srcset="" class="img-fluid"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">ADMIN KUAK MEDIA</li>

                <li class="sidebar-item  {{ (request()->is('admin')) ? 'active' : '' }}">
                    <a href="/admin" class='sidebar-link'>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ (request()->is('admin/kategori*')) ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}" class='sidebar-link'>
                        <span>Kategori Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ (request()->is('admin/artikel*')) ? 'active' : '' }}">
                    <a href="{{ route('artikel.index') }}" class='sidebar-link'>
                        <span>Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ (request()->is('admin/rekomendasi*')) ? 'active' : '' }}">
                    <a href="{{ route('rekomendasi.index') }}" class='sidebar-link'>
                        <span>Rekomendasi Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ (request()->is('admin/penulis*')) ? 'active' : '' }}">
                    <a href="{{ route('penulis.index') }}" class='sidebar-link'>
                        <span>Penulis</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                    <a href="{{ route('user.index') }}" class='sidebar-link'>
                        <span>Admin</span>
                    </a>
                </li>
                
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
