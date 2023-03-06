
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.6, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ env('APP_NAME') }}  </title>

        {{-- <link rel="icon" type="image/x-icon" href="landing_template/assets/favicon.ico" /> --}}
	    <link rel="icon" type="image/png" href="/landing_template/img/QC.png"/>
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="/landing_template/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">
                    <img src="/admin_template/img/QC.png" width="50" height="50" alt="Logo QC">
                </a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="#20">Bahan Baku</a></li>
                        <li class="nav-item"><a class="nav-link" href="#24">Timbangan in Proses</a></li>
                        @foreach($stations as $station)
                            <li class="nav-item"><a class="nav-link" href="#{{ $station->id }}">{{ $station->name }}</a></li>
                        @endforeach
                        <li class="nav-item"><a class="nav-link" href="#21">Keliling</a></li>
                        <li class="nav-item"><a class="nav-link" href="#22">Bahan Kimia</a></li>
                        <li class="nav-item"><a class="nav-link" href="#23">Flow NM</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Monitoring Hasil Analisa</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Tertanggal : {{ date('d-m-Y', strtotime(session('date'))) }}</p>
                        <a class="btn btn-dark btn-xl" href="{{ route('monitoring_select_date') }}">Ganti Tanggal</a>
                        <a class="btn btn-dark btn-xl" href="{{ route('home') }}">Kembali</a>
                    </div>
                </div>
            </div>
        </header>

        <section class="page-section bg-light" id="20">
            <h2 class="text-dark text-center mt-0">Bahan Baku</h2><br><br>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    <div class="col-lg-6 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Pos Brix</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>E-SPTA</th>
                                                <th>Brix</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($posbrixes as $posbrix)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($posbrix->created_at)) }}</td>
                                                <td>{{ $posbrix->spta }}</td>
                                                <td>{{ $posbrix->brix }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="col-lg-6 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Penilaian MBS</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Nopol</th>
                                                <th>Antrian</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($scores as $score)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($score->created_at)) }}</td>
                                                <td>{{ $score->rit->nopol }}</td>
                                                <td>{{ $score->rit->barcode_antrian }}</td>
                                                <td>{{ $score->value }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="col-lg-12 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Analisa Rendemen</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Nopol</th>
                                                <th>Antrian</th>
                                                <th>%Brix</th>
                                                <th>%Pol</th>
                                                <th>Pol</th>
                                                <th>Rend</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($aris as $ari)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($ari->created_at)) }}</td>
                                                <td>{{ $ari->ari_sampling->rit->nopol }}</td>
                                                <td>{{ $ari->ari_sampling->rit->barcode_antrian }}</td>
                                                <td>{{ $ari->pbrix }}</td>
                                                <td>{{ $ari->ppol }}</td>
                                                <td>{{ $ari->pol }}</td>
                                                <td>{{ $ari->yield }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                </div>
            </div>
        </section>

        <section class="page-section bg-white" id="24">
            <h2 class="text-dark text-center mt-0">Timbangan in Proses</h2><br><br>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    <div class="col-lg-4 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Tetes</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Netto<sub>(kg)</sub></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Harian</td>
                                                <td>{{ number_format($timbangan['tetes']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-4 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Raw Sugar In</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Netto<sub>(kg)</sub></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Harian</td>
                                                <td>{{ number_format($timbangan['rawsugarinput']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-4 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Raw Sugar Out</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Netto<sub>(kg)</sub></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Harian</td>
                                                <td>{{ number_format($timbangan['rawsugaroutput']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </section>

        @foreach($stations as $station)

        @if($station->id % 2 == 0)
        <section class="page-section bg-light" id="{{ $station->id }}">
            <h2 class="text-dark text-center mt-0">{{ $stations[$station->id-1]->name }}</h2><br><br>
            <div class="container px-4 px-lg-5">
        @else
        <section class="page-section bg-white" id="{{ $station->id }}">
            <h2 class="text-dark text-center mt-0">{{ $stations[$station->id-1]->name }}</h2><br><br>
            <div class="container px-4 px-lg-5">
        @endif
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    @foreach($material[$stations[$station->id-1]->id] as $materialx)
                    <div class="col-lg-6 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>{{ $materialx->name }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                @foreach($materialx->method as $method)
                                                    <td>{{ $method->indicator->name }}</td>
                                                @endforeach
                                                @if($materialx->id >= 43 && $materialx->id <= 49 )
                                                    <td>Pan</td>
                                                    <td>Hl</td>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($materialx->sample as $sample)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($sample->created_at)) }}</td>
                                                @foreach($materialx->method as $method)
                                                    <td>
                                                        @foreach($sample->analysis as $analysis)
                                                            @if($analysis->indicator->id == $method->indicator_id)
                                                                {{-- {{ $analysis->value }} --}}
                                                                {{ number_format($analysis->value, 2, ',' , '') }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                                @if($materialx->id >= 43 && $materialx->id <= 49 )
                                                <td>{{ $sample->pan }}</td>
                                                <td>{{ $sample->volume }}</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endforeach

        <section class="page-section bg-light" id="21">
            <h2 class="text-dark text-center mt-0">Keliling</h2><br><br>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    <div class="col-lg-12 text-left text-xs">
                        <div class="card bg-dark text-white shadow"><div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kactivities as $kactivity)
                                        <tr>
                                            <td>{{ date('H:i', strtotime($kactivity->created_at)) }}</td>
                                            <td>
                                                <ul class="list-group">
                                                @foreach($kactivity->kvalue as $kvalue)
                                                    <li class="list-group-item">{{ $kvalue->kspot->name }} = {{ $kvalue->value }}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section bg-white" id="22">
            <h2 class="text-dark text-center mt-0">Bahan Kimia</h2><br><br>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    <div class="col-lg-12 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($chemicalcheckings as $chemicalchecking)
                                        <tr>
                                            <td>{{ date('H:i', strtotime($chemicalchecking->created_at)) }}</td>
                                            <td>
                                                <ul class="list-group">
                                                @foreach($chemicalchecking->chemicalvalue as $chemicalvalue)
                                                    <li class="list-group-item">{{ $chemicalvalue->chemical->name }} = {{ $chemicalvalue->value }}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section bg-light" id="23">
            <h2 class="text-dark text-center mt-0">Flow NM</h2><br><br>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center text-left">
                    <div class="col-lg-6 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Nira Mentah</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Tebu</th>
                                                <th>Flow</th>
                                                <th>NM % Tebu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($balances as $balance)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($balance->created_at)) }}</td>
                                                <td>{{ $balance->tebu }}</td>
                                                <td>{{ $balance->flow_nm }}</td>
                                                <td>{{ $balance->nm_persen_tebu }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-6 text-left text-xs">
                        <div class="card bg-dark text-white shadow">
                            <div class="card-header">
                                <h5>Imbibisi</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-sm table-hovered text-light text-sm-left">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Flow</th>
                                                <th>Imbibisi % Tebu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($imbibitions as $imbibition)
                                            <tr>
                                                <td>{{ date('H:i', strtotime($imbibition->created_at)) }}</td>
                                                <td>{{ $imbibition->flow_imb }}</td>
                                                <td>{{ $imbibition->imb_persen_tebu }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5">
                <div class="small text-center text-muted">{{  env('APP_NAME') }} <br>Developed by &copy; <a href="https://wa.me/6285733465399" target="_blank">Andik Kurniawan</a></div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="/landing_template/js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
