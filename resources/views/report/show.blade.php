<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

        <title>{{ env('APP_NAME') }}</title>

        <link rel="icon" type="image/png" href="/admin_template/img/QC.png"/>
        <link href="/admin_template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="/admin_template/css/sb-admin-2.min.css" rel="stylesheet">
        <link href="/admin_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	</head>

	<body>

        @if($request->handling == 'export')
            @php
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Laporan_Silab_".$request->date.".xls");
            @endphp
        @endif

        <div class="wrapper">

            <section class="invoice">

                <br></br>

                <div class="row d-flex justify-content-center text-dark">
                    <div class="col-11 table-responsive">
                        <table border='1' cellpadding='0' width='100%'>
                            <thead>
                                <tr>
                                    <th rowspan='2'><img class='rounded mx-auto d-block' src='/admin_template/img/ka.jpg' width="100" height="100"></img></th>
                                    <th colspan='3' class='text-center'>
                                        <H6><STRONG>PT. KEBON AGUNG UNIT PABRIK GULA KEBON AGUNG</STRONG></H6>
                                        <p><SMALL>FORMULIR</SMALL></p>
                                        <H4><STRONG>LAPORAN SISTEM INFORMASI LABORATORIUM</STRONG></H4>
                                    </th>
                                    <th rowspan='2'><img class='rounded mx-auto d-block' src='/admin_template/img/QC.png' width="100" height="100"></img></th>
                                </tr>
                                <tr>
                                    <th class='text-center'>No Dok : KBA/FRM/QC/005-00</th>
                                    <th class='text-center'>Tanggal : {{ date('d-m-Y', strtotime($request->date)) }}</th>
                                    <th class='text-center'>
                                        @switch($request->shift)
                                            @case(1)
                                                {{ 'Shift Pagi' }}
                                                @break
                                            @case(2)
                                                {{ 'Shift Sore' }}
                                                @break
                                            @case(3)
                                                {{ 'Shift Malam' }}
                                                @break
                                            @default
                                                {{ 'Harian' }}
                                                @break
                                        @endswitch
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

              <br>

                <div class="row d-flex justify-content-center text-dark">
                    <div class="col-11 table-responsive">
                            <h6>Analisa Laboratorium</h6>
                            <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Material</th>
                                        <th>Sampel</th>
                                        <th>Hl</th>
                                        @foreach($indicators as $indicator)
                                            <th>{{ $indicator->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-xs">{{ $data['material'] }}</td>
                                        <td>{{ count($data['sample']) }}</td>
                                        <td>{{ $data['volume'] }}</td>
                                        @foreach($indicators as $indicator)
                                            <td>
                                                @if (array_key_exists($indicator->name, $data))
                                                    {{ number_format($data[$indicator->name], 2, ',' , '.') }}
                                                @else

                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>

                <div class="row d-flex justify-content-center text-dark">
                    <div class="col-6 table-responsive">
                        <h6>Timbangan in Proses</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                            <tr>
                                <th>Material</th>
                                <th>Netto<sub>(Kg)</sub></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Tetes</td>
                                <td>{{ number_format($timbangan['mollases'], 2, ',' , '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rawsugar Input</td>
                                <td>{{ number_format($timbangan['rawsugarinputs'], 2, ',' , '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rawsugar Output</td>
                                <td>{{ number_format($timbangan['rawsugaroutputs'], 2, ',' , '.') }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <h6>Keliling Proses</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Titik</th>
                                <th>Rerata</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($keliling as $keliling)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $keliling['name'] }}</td>
                                <td>{{ number_format($keliling['average'], 2, ',' , '.') }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <h6>Analisa Rendemen per Wilayah</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Wilayah</th>
                                    <th>Register</th>
                                    <th>Masuk<sub>(rit)</sub></th>
                                    <th>%Brix</th>
                                    <th>%Pol</th>
                                    <th>Rendemen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wilayah as $wilayah)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $wilayah['name'] }}</td>
                                    <td>{{ $wilayah['register'] }}</td>
                                    <td>{{ $wilayah['rit'] }}</td>
                                    <td>
                                        {{-- {{ $wilayah['pbrix'] }} --}}
                                        {{ number_format($wilayah['pbrix'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $wilayah['ppol'] }} --}}
                                        {{ number_format($wilayah['ppol'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $wilayah['yield'] }} --}}
                                        {{ number_format($wilayah['yield'], 2, ',' , '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><small><em>Note : This e-document is generated at {{ date('Y-m-d H:i:s') }} by {{ Auth()->user()->name }}.</em></small></p>
                    </div>

                    <div class="col-5 table-responsive">
                        <h6>Bahan Pembantu Proses</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Bahan Kimia</th>
                                <th>Pemakaian</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($chemical as $chemical)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $chemical['name'] }}</td>
                                <td>{{ $chemical['sum'] }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <h6>Balance Proses</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th>Tebu</th>
                                    <th>Material</th>
                                    <th>Flow</th>
                                    <th>% Tebu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td rowspan="2">{{ $balance['tebu'] }}</td>
                                    <td>Nira Mentah</td>
                                    <td>{{ $balance['flow_nm'] }}</td>
                                    <td>
                                        @if($balance['tebu'] > 0)
                                        {{ number_format($balance['flow_nm'] / $balance['tebu'] * 100, 2, ',' , '.') }}
                                        @else
                                        {{ '-' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Imbibisi</td>
                                    <td>{{ $balance['flow_imb'] }}</td>
                                    <td>
                                        @if($balance['tebu'] > 0)
                                        {{ number_format($balance['flow_imb'] / $balance['tebu'] * 100, 2, ',' , '.') }}
                                        @else
                                        {{ '-' }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h6>Pos Brix</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th rowspan="2">Jenis</th>
                                    <th rowspan="2">Masuk<sub>(rit)</sub></th>
                                    <th colspan="2">Diterima</th>
                                    <th colspan="2">Ditolak</th>
                                </tr>
                                <tr>
                                    <th>Rit</th>
                                    <th>Brix</th>
                                    <th>Rit</th>
                                    <th>Brix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Engkel Kecil</td>
                                    <td>{{ $posbrix['ek']->count() }}</td>
                                    <td>{{ $posbrix['ek']->where('is_accepted', 1)->count() }}</td>
                                    <td>
                                        {{ number_format($posbrix['brix_ek'], 2, ',' , '.') }}
                                    </td>
                                    <td>{{ $posbrix['ek']->where('is_accepted', 0)->count() }}</td>
                                    <td>
                                        {{ number_format($posbrix['brix_ek_ditolak'], 2, ',' , '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Engkel Besar & Gandeng</td>
                                    <td>{{ $posbrix['eb']->count() }}</td>
                                    <td>{{ $posbrix['eb']->where('is_accepted', 1)->count() }}</td>
                                    <td>
                                        {{ number_format($posbrix['brix_eb'], 2, ',' , '.') }}
                                    </td>
                                    <td>{{ $posbrix['eb']->where('is_accepted', 0)->count() }}</td>
                                    <td>
                                        {{ number_format($posbrix['brix_eb_ditolak'], 2, ',' , '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h6>Analisa Rendemen</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Masuk<sub>(rit)</sub></th>
                                    <th>%Brix</th>
                                    <th>%Pol</th>
                                    <th>Rendemen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Engkel Kecil</td>
                                    <td>{{ $ari['ek']->count() }}</td>
                                    <td>
                                        {{-- {{ $ari['ek']->avg('pbrix') }} --}}
                                        {{ number_format($ari['ek']->avg('pbrix'), 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $ari['ek']->avg('ppol') }} --}}
                                        {{ number_format($ari['ek']->avg('ppol'), 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $ari['ek']->avg('yield') }} --}}
                                        {{ number_format($ari['ek']->avg('yield'), 2, ',' , '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Engkel Besar & Gandeng</td>
                                    <td>{{ $ari['eb']->count() }}</td>
                                    <td>
                                        {{-- {{ $ari['eb']->avg('pbrix') }} --}}
                                        {{ number_format($ari['eb']->avg('pbrix'), 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $ari['eb']->avg('ppol') }} --}}
                                        {{ number_format($ari['eb']->avg('ppol'), 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $ari['eb']->avg('yield') }} --}}
                                        {{ number_format($ari['eb']->avg('yield'), 2, ',' , '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h6>Analisa Rendemen per KUD</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>KUD</th>
                                    <th>Register</th>
                                    <th>Masuk<sub>(rit)</sub></th>
                                    <th>%Brix</th>
                                    <th>%Pol</th>
                                    <th>Rendemen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kud as $kud)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kud['name'] }}</td>
                                    <td>{{ $kud['register'] }}</td>
                                    <td>{{ $kud['rit'] }}</td>
                                    <td>
                                        {{-- {{ $kud['pbrix'] }} --}}
                                        {{ number_format($kud['pbrix'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $kud['ppol'] }} --}}
                                        {{ number_format($kud['ppol'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $kud['yield'] }} --}}
                                        {{ number_format($kud['yield'], 2, ',' , '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h6>Analisa Rendemen per Pos Pantau</h6>
                        <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pos Pantau</th>
                                    <th>Register</th>
                                    <th>Masuk<sub>(rit)</sub></th>
                                    <th>%Brix</th>
                                    <th>%Pol</th>
                                    <th>Rendemen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pospantau as $pospantau)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pospantau['name'] }}</td>
                                    <td>{{ $pospantau['register'] }}</td>
                                    <td>{{ $pospantau['rit'] }}</td>
                                    <td>
                                        {{-- {{ $pospantau['pbrix'] }} --}}
                                        {{ number_format($pospantau['pbrix'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $pospantau['ppol'] }} --}}
                                        {{ number_format($pospantau['ppol'], 2, ',' , '.') }}
                                    </td>
                                    <td>
                                        {{-- {{ $pospantau['yield'] }} --}}
                                        {{ number_format($pospantau['yield'], 2, ',' , '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>

                    </div>
                </div>

            </section>
        </div>

        <br>

