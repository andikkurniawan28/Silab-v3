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
                                      <H4><STRONG>SURAT KETERANGAN MUTU TEBU</STRONG></H4>
                                  </th>
                                  <th rowspan='2'><img class='rounded mx-auto d-block' src='/admin_template/img/QC.png' width="100" height="100"></img></th>
                              </tr>
                              <tr>
                                  <th class='text-center'>No Dok : KBA/FRM/QC/005-00</th>
                                  <th class='text-center'>Tanggal : {{ date('d F Y', strtotime($score->created_at)) }}</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>

              <br>

              <div class='row d-flex justify-content-center'>

                <div class="col-11 table-responsive">

                    <h4 class='text-left text-dark'><strong>Laporan Hasil Scoring</strong></h4>

                        <table width='100%' border='1' class="text-dark" cellpadding='5'>
                            <tr>
                                <th bgcolor='#00FFFF'>Nomor Antrian</th>
                                <td>{{ $score->rit->barcode_antrian }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Nomor Polisi</th>
                                <td>{{ $score->rit->nopol }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Register</th>
                                <td>{{ $score->rit->register }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Petani</th>
                                <td>{{ $score->rit->petani }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Timestamp</th>
                                <td>{{ $score->created_at }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Meja Tebu</th>
                                <td>{{ $score->cane_table }}</td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Kotoran</th>
                                <td>
                                    <ul>
                                        @foreach($score->scoring_value as $scoring_value)
                                            <li>{{ $scoring_value->dirt->name }} : {{ $scoring_value->value }}%</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th bgcolor='#00FFFF'>Score</th>
                                <td><strong>{{ $score->value }}</strong></td>
                            </tr>
                        </table>

                        <br>

                        <table width='100%' border='1' class="text-dark" cellpadding='10'>
                            <tr>
                                <th bgcolor='#00FFFF' colspan='3'>Dokumentasi</th>
                            </tr>
                            <tr>
                                <td><img class='img-fluid' src="/{{ $score->image1 }}" width="450" height="375"></img></td>
                                <td><img class='img-fluid' src="/{{ $score->image2 }}" width="450" height="375"></img></td>
                            </tr>
                        </table>

                        <br>

                        <h6 align='justify' class="text-dark">
                            Bahwasanya dari hasil pengamatan Tim Quality Control PG. Kebon Agung, tebu saudara
                            @switch($score->value)
                                @case("A")
                                    <b>telah memenuhi</b>
                                    @break
                                @case("B")
                                    <b>telah memenuhi</b>
                                    @break
                                @case("C")
                                    <b>belum memenuhi</b>
                                    @break
                                @case("D")
                                    <b>belum memenuhi</b>
                                    @break
                                @case("E")
                                    <b>belum memenuhi</b>
                                    @break
                                @case("F")
                                    <b>belum memenuhi</b>
                                    @break
                            @endswitch
                             persyaratan Manis Bersih Segar (MBS), sesuai hasil kesepakatan rapat Forum Temu Mitra antara perwakilan petani, pengurus KUD, Koperasi dan APTRI serta Instansi terkait dengan PG. Kebon
                            Agung saat menjelang pelaksanaan giling tahun {{ date('Y') }}.
                        </h6>

                        <br>

                        <h6 align='justify' class="text-dark">
                            Demikian pemberitahuan ini dibuat, semoga kedepan dapat
                            @switch($score->value)
                                @case("A")
                                    <b>dipertahankan</b>
                                    @break
                                @case("B")
                                    <b>ditingkatkan</b>
                                    @break
                                @case("C")
                                    <b>ditingkatkan</b>
                                    @break
                                @case("D")
                                    <b>ditingkatkan</b>
                                    @break
                                @case("E")
                                    <b>ditingkatkan</b>
                                    @break
                                @case("F")
                                    <b>ditingkatkan</b>
                                    @break
                            @endswitch
                             kualitas tebu yang dikirimkan. Atas perhatiannya, kami ucapkan terimakasih.
                        </h6>

                    <br>

                </div>

            </div>

			<br>

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                        <p class='text-center'></p>
                        <br></br><br></br>
                        <br></br>
                        <p class='text-center'></p>
                        <p class='text-center'></p>
                </div>
                <!-- /.col -->
                <!--<div class="col-4">
                </div>--.
                <!-- /.col -->
                <div class="col-6">
                        <p class='text-center text-dark'>Kebon Agung, {{ date('d F Y', strtotime($score->created_at)) }}</p>
                        {{-- <p class='text-center text-dark'><img class='rounded mx-auto d-block' src="" width="100" height="100"></img></p> --}}
                        <br><br><br><br>
                        <p class='text-center text-dark'><strong><u>M Anas Mu'allif</u></strong></p>
                        <p class='text-center text-dark'>Kepala Bagian Quality Control</p>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <br>

                <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <!--<div class="col-4">
                </div>--.
                <!-- /.col -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
