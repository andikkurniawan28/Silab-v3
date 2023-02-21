@extends('layouts.app')

@section('content')
<div class="container-fluid">

    @if($message = Session::get('error'))
        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
    @elseif($message = Session::get('success'))
        @include('components.alert', ['message'=>$message, 'color'=>'success'])
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('penilaian Kotoran') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>MBS</td>
                            <td>Kotoran</td>
                            <td>Nilai</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scoring_values as $scoring_value)
                        <tr>
                            <td>{{ $scoring_value->id }}</td>
                            <td>{{ $scoring_value->created_at }}</td>
                            <td>{{ $scoring_value->score->id }}</td>
                            <td>{{ $scoring_value->dirt->name }}</td>
                            <td>{{ $scoring_value->value }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $scoring_value->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button> --}}
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $scoring_value->id }}">
                                    @include('components.icon', ['icon' => 'trash '])
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create">
                @include('components.icon', ['icon' => 'plus '])
                Tambah
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" scoring_value="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" scoring_value="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('penilaian Kotoran') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('scoring_values.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="score_id" class="col-sm-2 col-form-label">MBS</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="score_id">
                            @foreach ($scores as $score)
                                <option value="{{ $score->id }}">
                                    {{ $score->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dirt_id" class="col-sm-2 col-form-label">Kotoran</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dirt_id">
                            @foreach ($dirts as $dirt)
                                <option value="{{ $dirt->id }}">
                                    {{ $dirt->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Nilai',
                    'name' => 'value',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

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

{{-- @foreach($scoring_values as $scoring_value)
<div class="modal fade" id="edit{{ $scoring_value->id }}" tabindex="-1" scoring_value="dialog" aria-labelledby="edit{{ $scoring_value->id }}Label" aria-hidden="true">
    <div class="modal-dialog" scoring_value="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $scoring_value->id }}Label">Edit {{ ucfirst('penilaian Kotoran') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('scoring_values.update', $scoring_value->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="score_id" class="col-sm-2 col-form-label">MBS</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="score_id">
                            @foreach ($scores as $score)
                                <option value="{{ $score->id }}">
                                    {{ $score->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dirt_id" class="col-sm-2 col-form-label">Kotoran</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dirt_id">
                            @foreach ($dirts as $dirt)
                                <option value="{{ $dirt->id }}">
                                    {{ $dirt->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Nilai',
                    'name' => 'value',
                    'type' => 'number',
                    'value' => $scoring_value->value,
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
@endforeach --}}

@foreach($scoring_values as $scoring_value)
<div class="modal fade" id="delete{{ $scoring_value->id }}" tabindex="-1" scoring_value="dialog" aria-labelledby="delete{{ $scoring_value->id }}Label" aria-hidden="true">
    <div class="modal-dialog" scoring_value="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $scoring_value->id }}Label">Hapus {{ ucfirst('penilaian Kotoran') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('scoring_values.destroy', $scoring_value->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'Nilai',
                    'name' => 'value',
                    'type' => 'number',
                    'value' => $scoring_value->value,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="scoring_value_id" value="{{ $scoring_value->scoring_value_id }}">
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

