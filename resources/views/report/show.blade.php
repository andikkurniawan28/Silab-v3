<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ env('APP_NAME') }}</title>
	<link rel="icon" type="image/png" href="/admin_template/img/QC.png"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/admin_template/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/admin_template/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">


        <div class="row">
            <div class="col col-md-12 text-dark">
                <h3>Report</h3><hr>
                    <h6>Analisa Laboratorium</h6>
                    <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                        <thead>
                            <tr>
                                <th colspan="3">Tanggal / Shift : {{ $request->date }} / {{ $request->shift }}</th>
                                <th colspan="{{ count($indicators) }}">Rerata</th>
                            </tr>
                        </thead>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Material</th>
                                <th>Sampel</th>
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
                                @foreach($indicators as $indicator)
                                    <td>
                                        @if (array_key_exists($indicator->name, $data))
                                            {{ $data[$indicator->name] }}
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

        <div class="row">
            <div class="col col-md-6 text-dark">
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
                        <td>{{ $keliling['average'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col col-md-6 text-dark">
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
                                {{ $balance['flow_nm'] / $balance['tebu'] * 100 }}
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
                                {{ $balance['flow_imb'] / $balance['tebu'] * 100 }}
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
                            <th>Jenis</th>
                            <th>Masuk<sub>(rit)</sub></th>
                            <th>Diterima<sub>(rit)</sub></th>
                            <th>Brix Rerata Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Engkel Kecil</td>
                            <td>{{ $posbrix['ek']->count() }}</td>
                            <td>{{ $posbrix['ek']->where('is_accepted', 1)->count() }}</td>
                            <td>{{ number_format($posbrix['brix_ek'], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Engkel Besar & Gandeng</td>
                            <td>{{ $posbrix['eb']->count() }}</td>
                            <td>{{ $posbrix['eb']->where('is_accepted', 1)->count() }}</td>
                            <td>{{ number_format($posbrix['brix_eb'], 2) }}</td>
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
                            <td>{{ $ari['ek']->avg('pbrix') }}</td>
                            <td>{{ $ari['ek']->avg('ppol') }}</td>
                            <td>{{ $ari['ek']->avg('yield') }}</td>
                        </tr>
                        <tr>
                            <td>Engkel Besar & Gandeng</td>
                            <td>{{ $ari['eb']->count() }}</td>
                            <td>{{ $ari['eb']->avg('pbrix') }}</td>
                            <td>{{ $ari['eb']->avg('ppol') }}</td>
                            <td>{{ $ari['eb']->avg('yield') }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>

            </div>
        </div>

    </div>
</body>
