<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="refresh" content="5;URL='{{ route('meja_selatan') }}'">

<head>

    @include('layouts.head')

</head>

<body class="bg-gradient-info">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <br><br>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h1 text-gray-900 mb-4">Score Penilaian</h1>
                                        <h1 class="h1 text-gray-900 mb-4"><strong>{{ $score }}</strong></h1>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('layouts.script')

</body>

</html>
