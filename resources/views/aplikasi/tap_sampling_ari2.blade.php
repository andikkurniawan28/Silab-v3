<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <br><br>

                @if ($errors->any())
                <br>
                    <div class="alert alert-danger">
                        <p>Error :</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($message = Session::get('error'))
                    @include('components.alert', ['message'=>$message, 'color'=>'danger'])
                @endif

                @if($message = Session::get('success'))
                    @include('components.alert', ['message'=>$message, 'color'=>'success'])
                @endif

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tap Sampling ARI EB/GD</h1>
                                    </div>
                                    <form class="user" action="{{ route('tap_sample_ari_eb_process') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                        <div class="form-group">
                                            <label for="rfid" class="col-auto col-form-label">RFID</label>
                                            <input type="text" class="text-lg form-control form-control-user"
                                                id="rfid" name="rfid" placeholder="Tap Kartu RFID" autofocus required>
                                        </div>
                                    </form>
                                </div>
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
