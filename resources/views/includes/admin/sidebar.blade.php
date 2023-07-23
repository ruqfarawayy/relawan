<!-- Sidebar -->
<ul
    class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion"
    id="accordionSidebar"
>
    <!-- Sidebar - Brand  Logo-->
    <a
        class="d-flex align-items-center justify-content-center"
        href="{{ url('admin') }}"
    >
        <img
            class="img-profile"
            style="width: 5rem; margin: auto"
            src="{{ url('logo.png') }}"
        />
    </a>
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ url('admin') }}"
    >
        <div class="sidebar-brand-text mx-3">KAB BANYUMAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('admin') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a
        >
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Menu Relawan</div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('volunteer.index') }}">
            <i class="fas fa-duotone fa-users"></i>
            <span>Data Relawan</span></a
        >
    </li>
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('unit.index') }}">
            <i class="fas fa-duotone fa-users"></i>
            <span>Manajemen Unit</span></a
        >
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Menu Dokumen</div>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('file_encryption.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Manajemen Dokumen</span></a
        >
    </li>

     <li class="nav-item">
         <form method="post" action="{{ route('logout') }}">
             @csrf
            <button class="nav-link btn ">
                <i class="fas fa-sign-out-alt"></i>
                <small>Logout</small>
            </button>
        </form>
        </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
