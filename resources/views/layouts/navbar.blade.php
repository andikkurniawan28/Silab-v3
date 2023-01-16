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
            {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth()->user()->name }}</span> --}}
            {{-- @if(auth()->user()->image == NULL)
                <img class="img-profile rounded-circle" src="/admin_template/img/undraw_profile.svg">
             @else
                <img class="img-profile rounded-circle" src="{{ Storage::url('public/image/').auth()->user()->image }}">
            @endif --}}
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#uploadImage">
                <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i> Upload Image
            </a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassword">
                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i> Change Password
            </a>
            {{-- <a class="dropdown-item" href="{{ route('activity_log_by_user') }}">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log
            </a> --}}
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
            </a>
        </div>
    </li>

    </ul>

</nav>
<!-- End of Topbar -->
