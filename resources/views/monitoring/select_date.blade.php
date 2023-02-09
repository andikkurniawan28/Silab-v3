<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

</head>

<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Monitoring</h1>
                                    </div>
                                    <form class="user" action="{{ route('monitoring_save_date') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                        <div class="form-group">
                                            <label for="date" class="col-auto col-form-label">Tanggal</label>
                                            <input type="date" class="text-lg form-control form-control-user"
                                                id="date" name="date" autofocus required>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-user btn-block text-white">
                                            Set
                                        </button>
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
