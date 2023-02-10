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
                                        <h1 class="h4 text-gray-900 mb-4">Penilaian MBS</h1>
                                    </div>
                                    <form class="user" action="{{ route('scores.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                        <div class="form-group">
                                            <label for="rit_id" class="col-auto col-form-label">Nopol -- Barcode Antrian</label>
                                            <select class="form-control" name="rit_id">
                                                @foreach ($rits as $rit)
                                                    <option value="{{ $rit->id }}">
                                                        {{ $rit->nopol }} -- {{ $rit->barcode_antrian }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="value" class="col-auto col-form-label">Score</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="value" name="value" placeholder="Score" autofocus required>
                                        </div>
                                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                                        <button type="submit" class="btn btn-dark btn-user btn-block">
                                            Simpan
                                        </button>
                                        <hr>
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
