@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if($message = Session::get('error'))
        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
    @elseif($message = Session::get('success'))
        @include('components.alert', ['message'=>$message, 'color'=>'success'])
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <p>Error :</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('penilaian MBS') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            {{-- <td>Nopol</td> --}}
                            <td>Barcode</td>
                            <td><a href="{{ route('dirts.index') }}" target="_blank">Kotoran</a></td>
                            <td>Score</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scores as $score)
                        <tr>
                            <td>{{ $score->id }}</td>
                            <td>{{ $score->created_at }}</td>
                            {{-- <td>{{ $score->rit->nopol }}</td> --}}
                            <td>{{ $score->rit->barcode_antrian }}</td>
                            <td>
                                <ul>
                                @forelse($score->scoring_value as $scoring_value)
                                    <li>{{ $scoring_value->dirt->name }} : {{ $scoring_value->value }}%</li>
                                @empty

                                @endforelse
                                </ul>
                            </td>
                            <td>{{ $score->value }}</td>
                            <td>{{ $score->user->name }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $score->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button> --}}
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $score->id }}">
                                    @include('components.icon', ['icon' => 'trash '])
                                    Hapus
                                </button>
                                <a target="_blank" href="{{ route('skmt', $score->id) }}" class="btn btn-outline-info btn-sm">
                                    @include('components.icon', ['icon' => 'file '])
                                    SKMT
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @for($i=1; $i<=5; $i++)
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create{{ $i }}">
                @include('components.icon', ['icon' => 'plus '])
                Meja Tebu {{ $i }}
            </button>
            @endfor
        </div>
    </div>
</div>

@for($i=1; $i<=5; $i++)
<div class="modal fade" id="create{{ $i }}" tabindex="-1" score="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" score="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">{{ ucfirst('penilaian MBS') }} Meja {{ $i }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('scores.store') }}" class="text-dark" enctype="multipart/form-data">
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
                                        btn-toggle  btn-sm">
                                    <input type="radio" name="{{ $dirt->id }}" id="{{ $dirt->id }}" autocomplete="off" value="{{ $j }}"
                                    @if($j == 0)
                                    {{ 'checked' }}
                                    @endif
                                    > {{ $j }}%
                                </label>
                            @endfor
                        </div>
                    </div>
                </div>
                @endforeach

                <input type="hidden" name="cane_table" value="{{ $i }}">
                <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save
                    @include('components.icon', ['icon' => 'save'])
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endfor

@foreach($scores as $score)
<div class="modal fade" id="edit{{ $score->id }}" tabindex="-1" score="dialog" aria-labelledby="edit{{ $score->id }}Label" aria-hidden="true">
    <div class="modal-dialog" score="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $score->id }}Label">Edit {{ ucfirst('penilaian MBS') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('scores.update', $score->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                {{-- @include('components.input',[
                    'label' => 'Antrian',
                    'name' => 'rit_id',
                    'type' => 'text',
                    'value' => $score->rit->barcode_antrian,
                    'modifier' => 'readonly',
                ]) --}}

                @include('components.input',[
                    'label' => 'Score',
                    'name' => 'value',
                    'type' => 'text',
                    'value' => $score->value,
                    'modifier' => 'required',
                ])

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save
                    @include('components.icon', ['icon' => 'edit'])
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($scores as $score)
<div class="modal fade" id="delete{{ $score->id }}" tabindex="-1" score="dialog" aria-labelledby="delete{{ $score->id }}Label" aria-hidden="true">
    <div class="modal-dialog" score="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $score->id }}Label">Hapus {{ ucfirst('penilaian MBS') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('scores.destroy', $score->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary">Yes
                    @include('components.icon', ['icon' => 'trash'])
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

