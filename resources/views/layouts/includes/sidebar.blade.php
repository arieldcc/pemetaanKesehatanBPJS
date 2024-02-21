<div class="sidebar" data-color="blue" data-image="{{ url('/') }}/assets/img/sidebar-4.jpg">
    <!--
Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

Tip 2: you can also add an image using data-image tag
-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Pemetaan Fasilitas Kesehatan BPJS
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item {{ $menu=='dashboard'? 'active':'' }}">
                <a class="nav-link" href="/dashboard">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}
            <!-- Heading -->
            <div class="sidebar-heading">
                <i class="nc-icon nc-layers-3"></i>
                Data Master
            </div>
            <li class="nav-item {{ $menu=='data-kategori'? 'active':'' }}">
                <a class="nav-link" href="/data-kategori">
                    <i class="nc-icon nc-grid-45"></i>
                    <p>Data Kategori</p>
                </a>
            </li>
            <li class="nav-item {{ $menu=='data-fasilitas'? 'active':'' }}">
                <a class="nav-link" href="/data-fasilitas">
                    <i class="nc-icon nc-square-pin"></i>
                    <p>Lokasi dan Fasilitas</p>
                </a>
            </li>
            <li class="nav-item {{ $menu=='data-dokter'? 'active':'' }}">
                <a class="nav-link" href="/data-dokter">
                    <i class="nc-icon nc-badge "></i>
                    <p>Data Dokter</p>
                </a>
            </li>
            <li class="nav-item {{ $menu=='data-jadwal'? 'active':'' }}">
                <a class="nav-link" href="/data-jadwal">
                    <i class="nc-icon nc-notification-70"></i>
                    <p>Jadwal Dokter</p>
                </a>
            </li>
            <li class="nav-item {{ $menu=='data-layanan'? 'active':'' }}">
                <a class="nav-link" href="/data-layanan">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Layanan Fasilitas</p>
                </a>
            </li>
            <div class="sidebar-heading">
                <i class="nc-icon nc-settings-tool-66"></i>
                Data View
            </div>
            <li class="nav-item {{ $menu=='data-lokasi'? 'active':'' }}">
                <a class="nav-link" href="/data-lokasi">
                    <i class="nc-icon nc-map-big"></i>
                    <p>Lokasi Fasilitas</p>
                </a>
            </li>
            <div class="sidebar-heading">
                <i class="nc-icon nc-settings-tool-66"></i>
                Tools
            </div>
            <li class="nav-item {{ $menu=='data-user'? 'active':'' }}">
                <a class="nav-link" href="/data-user">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User</p>
                </a>
            </li>
        </ul>
    </div>
</div>
