<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

</head>

<body class="bg-gradient-warning">

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
                                        <h1 class="h4 text-gray-900 mb-4">Pos Brix</h1>
                                    </div>
                                    <form class="user" action="{{ route('process_rfid') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                        <div class="form-group">
                                            <label for="spta" class="col-auto col-form-label">E-SPTA</label>
                                            <input type="text" class="form-control form-control-user" id="spta" name="spta" value="{{ $spta }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="spta" class="col-auto col-form-label">Jenis</label>
                                            <input type="text" class="form-control form-control-user" id="category" name="category" value="{{ $category }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="brix" class="col-auto col-form-label">Brix</label>
                                            <input type="number" class="form-control form-control-user"
                                                id="brix" name="brix" placeholder="Masukkan Nilai Brix" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputState">Status</label>
                                            <select id="inputState" class="form-control" name="is_accepted">
                                                <option value="1" selected>Diterima</option>
                                                <option value="0">Ditolak</option>
                                            </select>
                                        </div>
                                        <br><br>
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
