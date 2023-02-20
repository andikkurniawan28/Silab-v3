<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow text-dark">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>

        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </li>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="/admin_template/img/undraw_profile.svg">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


            @if(Auth()->user()->role_id <= 1)
            <a class="dropdown-item" href="{{ route('users.index') }}">
                <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i> User
            </a>
            @endif

            @if(Auth()->user()->role_id <= 3)
            <a class="dropdown-item" href="{{ route('stations.index') }}">
                <i class="fas fa-filter fa-sm fa-fw mr-2 text-gray-400"></i> Stasiun
            </a>
            <a class="dropdown-item" href="{{ route('indicators.index') }}">
                <i class="fas fa-asterisk fa-sm fa-fw mr-2 text-gray-400"></i> Indikator
            </a>
            <a class="dropdown-item" href="{{ route('factors.index') }}">
                <i class="fas fa-percent fa-sm fa-fw mr-2 text-gray-400"></i> Faktor
            </a>
            @endif

            @if(Auth()->user()->role_id <= 4)
            <a class="dropdown-item" href="{{ route('dirts.index') }}">
                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Kotoran
            </a>
            @endif

            @if(Auth()->user()->role_id <= 7)
            <a class="dropdown-item" href="{{ route('materials.index') }}">
                <i class="fas fa-box fa-sm fa-fw mr-2 text-gray-400"></i> Material
            </a>
            <a class="dropdown-item" href="{{ route('methods.index') }}">
                <i class="fas fa-flask fa-sm fa-fw mr-2 text-gray-400"></i> Method
            </a>
            @endif

            @if(Auth()->user()->role_id <= 8)
            <a class="dropdown-item" href="{{ route('samples.index') }}">
                <i class="fas fa-barcode fa-sm fa-fw mr-2 text-gray-400"></i> Sample
            </a>
            @endif

            @if(Auth()->user()->role_id <= 3)
            <a class="dropdown-item" href="{{ route('kspots.index') }}">
                <i class="fas fa-map fa-sm fa-fw mr-2 text-gray-400"></i> Titik Keliling
            </a>
            <a class="dropdown-item" href="{{ route('tspots.index') }}">
                <i class="fas fa-eye fa-sm fa-fw mr-2 text-gray-400"></i> Titik Taksasi
            </a>
            @endif

            @if(Auth()->user()->role_id <= 4)
            <a class="dropdown-item" href="{{ route('chemicals.index') }}">
                <i class="fas fa-flask fa-sm fa-fw mr-2 text-gray-400"></i> Bahan Pembantu Proses
            </a>
            @endif

            @if(Auth()->user()->role_id <= 2)
            <a class="dropdown-item" href="{{ route('activities') }}">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
            </a>
            @endif

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
            </a>
        </div>
    </li>

    </ul>

</nav>
<!-- End of Topbar -->
