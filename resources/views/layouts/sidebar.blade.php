<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="/admin_template/img/QC.png" width="50" height="50" alt="Logo QC">
        </div>
        <div class="sidebar-brand-text mx-3">SILAB</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('monitoring_select_date') }}" target="_blank">
        <i class="fas fa-fw fa-eye"></i>
        <span>Monitoring</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Hasil Analisa</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                @foreach($stations as $station)
                    <a class="collapse-item" href="{{ route('station_result', $station->id) }}">{{ $station->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    @if(Auth()->user()->role_id <= 9)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-edit"></i>
            <span>Data Off Farm</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                @if(Auth()->user()->role_id < 9)
                <a class="collapse-item" href="{{ route('cetak_barcode') }}">Cetak Barcode</a>
                <a class="collapse-item" href="{{ route('analyses.index') }}">Analisa</a>
                <a class="collapse-item" href="{{ route('saccharomat') }}">Saccharomat</a>
                <a class="collapse-item" href="{{ route('analisa_ampas') }}">Analisa Ampas</a>
                <a class="collapse-item" href="{{ route('analisa_umum') }}">Analisa Umum</a>
                <a class="collapse-item" href="{{ route('analisa_ketel') }}">Analisa Ketel</a>
                <a class="collapse-item" href="{{ route('analisa_hplc') }}">Analisa HPLC</a>
                <a class="collapse-item" href="{{ route('balances.index') }}">Flow NM</a>
                <a class="collapse-item" href="{{ route('kactivities.index') }}">Keliling Proses</a>
                <a class="collapse-item" href="{{ route('chemicalcheckings.index') }}">Pengunaan BPP</a>
                @endif

                <a class="collapse-item" href="{{ route('cetak_ronsel') }}">Cetak Ronsel</a>
                <a class="collapse-item" href="{{ route('tactivities.index') }}">Taksasi</a>
                <a class="collapse-item" href="{{ route('imbibitions.index') }}">Imbibisi</a>

                @if(Auth()->user()->role_id < 6)
                <a class="collapse-item" href="{{ route('mollases.index') }}">Timbangan Tetes</a>
                <a class="collapse-item" href="{{ route('rawsugarinputs.index') }}">Timbangan RS In</a>
                <a class="collapse-item" href="{{ route('rawsugaroutputs.index') }}">Timbangan RS Out</a>
                @endif
            </div>
        </div>
    </li>
    @endif

    @if(Auth()->user()->role_id < 9)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities1">
            <i class="fas fa-fw fa-edit"></i>
            <span>Data On Farm</span>
        </a>
        <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                <a class="collapse-item" href="{{ route('rits.index') }}">Penerimaan</a>
                <a class="collapse-item" href="{{ route('posbrixes.index') }}">Pos Brix</a>
                <a class="collapse-item" href="{{ route('ari_samplings.index') }}">Sampling ARI</a>
                <a class="collapse-item" href="{{ route('aris.index') }}">Analisa Rendemen</a>
                <a class="collapse-item" href="{{ route('scores.index') }}">Penilaian MBS</a>
                <a class="collapse-item" href="{{ route('scoring_values.index') }}">Penilaian Kotoran</a>
            </div>
        </div>
    </li>
    @endif

    @if(Auth()->user()->role_id <= 7)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-file-signature"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                    <a class="collapse-item" href="{{ route('report') }}">Cetak Laporan</a>
            </div>
        </div>
    </li>
    @endif

    @if(Auth()->user()->role_id <= 7)
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
            <i class="fas fa-fw fa-mobile"></i>
            <span>Aplikasi</span>
        </a>
        <div id="collapse2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                <a class="collapse-item" href="{{ route('scan_rfid') }}" target="_blank">Pos Brix EK</a>
                <a class="collapse-item" href="{{ route('scan_rfid_eb') }}" target="_blank">Pos Brix EB/GD</a>
                <a class="collapse-item" href="{{ route('tap_timbangan') }}" target="_blank">Tap Timbangan EK</a>
                <a class="collapse-item" href="{{ route('tap_timbangan_eb') }}" target="_blank">Tap Timbangan EB/GD</a>
                <a class="collapse-item" href="{{ route('tap_sample_ari') }}" target="_blank">Tap Sampel ARI EK</a>
                <a class="collapse-item" href="{{ route('tap_sample_ari_eb') }}" target="_blank">Tap Sampel ARI EB/GD</a>
            </div>
        </div>
    </li>
    @endif

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
