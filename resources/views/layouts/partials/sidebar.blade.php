<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pertanyaan.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Stack Overflow <sup>KW</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Halaman Index -->
    <li class="nav-item">
        {{-- <a class="nav-link" href="/pertanyaan/create">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Buat Pertanyaan</span></a> --}}
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-folder"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pertanyaan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="/pertanyaan/create">Buat Pertanyaan</a>
                <a class="collapse-item" href="#">Pertanyaan-ku</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Profil -->
    <li class="nav-item">
        {{-- <a class="nav-link" href="/pertanyaan/create">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Buat Pertanyaan</span></a> --}}
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Profil Pengguna</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
