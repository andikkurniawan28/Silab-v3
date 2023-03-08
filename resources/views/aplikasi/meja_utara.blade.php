<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

</head>

<body class="bg-gradient-danger">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-12">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Penilaian Tebu Meja Utara</h1>
                                    </div>

                                    <form method="POST" action="{{ route('proses_meja_utara') }}" class="text-dark" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')

                                        <div class="form-group row">
                                            <label for="rit_id" class="col-sm-3 col-form-label">Identitas</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="rit_id">
                                                    @foreach ($rits as $rit)
                                                        <option value="{{ $rit->id }}">
                                                            Nopol : {{ $rit->nopol }} -- Antrian :  {{ $rit->barcode_antrian }} -- Brix : {{ $rit->posbrix->brix }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="{{ 'cane_table' }}" class="col-sm-3 col-form-label">{{ ucfirst('Meja Tebu') }}</label>
                                            <div class="col-sm-9">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    @for($k=4; $k<=5; $k++)
                                                    <label class="btn btn-outline-primary btn-toggle btn-md">
                                                        <input type="radio" name="{{ 'cane_table' }}" id="{{ 'cane_table' }}" autocomplete="off" value="{{ $k }}"> {{ $k }}
                                                    </label>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($dirts as $dirt)
                                        <div class="form-group row">
                                            <label for="{{ $dirt->id }}" class="col-sm-3 col-form-label">{{ $dirt->name }}</label>
                                            <div class="col-sm-9">
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    @for($j=0; $j<=90; $j+=10)
                                                        <label class="btn
                                                            @if($j < 10)
                                                                {{ 'btn-outline-danger' }}
                                                            @else
                                                                {{ 'btn-outline-primary' }}
                                                            @endif
                                                                btn-toggle  btn-md">
                                                            <input type="radio" name="{{ $dirt->id }}" id="{{ $dirt->id }}" autocomplete="off" value="{{ $j }}"
                                                                @if($j == 0)
                                                                    {{ 'checked' }}
                                                                @endif
                                                            >
                                                            {{ $j }}%
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

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
