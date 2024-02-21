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
        </ul>
    </div>
</div>
