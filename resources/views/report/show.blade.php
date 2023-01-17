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
                {{-- <div class="font-weight-bold text-dark text-uppercase mb-1">
                    <br>
                    Laporan Analisa Laboratorium
                </div> --}}
                {{-- <div class="table-responsive"> --}}
                    <br>
                    <table width="100%" class="table table-dark table-striped table-sm table-bordered table-hover text-xs">
                        <thead>
                            <tr>
                                <th class="text-xs" colspan="3">Tanggal / Shift : {{ $request->date }} / {{ $request->shift }}</th>
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
                {{-- </div> --}}
            </div>
        </div>
    </div>
</body>
