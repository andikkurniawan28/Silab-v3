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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('analisa') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Sample</td>
                            <td>Material</td>
                            <td>Indikator</td>
                            <td>Value</td>
                            {{-- <td>User</td> --}}
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($analyses as $analysis)
                        <tr>
                            <td>{{ $analysis->id }}</td>
                            <td>{{ $analysis->created_at }}</td>
                            <td>{{ $analysis->sample_id }}</td>
                            <td>{{ $analysis->sample->material->name }}</td>
                            <td>{{ $analysis->indicator->name }}</td>
                            <td>{{ $analysis->value }}</td>
                            {{-- <td>{{ $analysis->user->name }}</td> --}}
                            <td>
                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#show{{ $analysis->id }}">
                                    @include('components.icon', ['icon' => 'info '])
                                    Info
                                </button>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $analysis->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $analysis->id }}">
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

<div class="modal fade" id="create" tabindex="-1" analysis="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" analysis="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('analisa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('analyses.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @include('components.input',[
                    'label' => 'Sample',
                    'name' => 'sample_id',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Indikator</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="indicator_id">
                            @foreach ($indicators as $indicator)
                                <option value="{{ $indicator->id }}">
                                    {{ $indicator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                @include('components.input',[
                    'label' => 'Value',
                    'name' => 'value',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

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

@foreach($analyses as $analysis)
<div class="modal fade" id="edit{{ $analysis->id }}" tabindex="-1" analysis="dialog" aria-labelledby="edit{{ $analysis->id }}Label" aria-hidden="true">
    <div class="modal-dialog" analysis="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $analysis->id }}Label">Edit {{ ucfirst('analisa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('analyses.update', $analysis->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                @include('components.input',[
                    'label' => 'Sample',
                    'name' => 'sample_id',
                    'type' => 'number',
                    'value' => $analysis->sample_id,
                    'modifier' => 'required',
                ])

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Indikator</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="indicator_id">
                            @foreach ($indicators as $indicator)
                                <option
                                @if($indicator->id == $analysis->indicator_id)
                                {{ 'selected' }}
                                @endif
                                value="{{ $indicator->id }}">
                                 {{ $indicator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Value',
                    'name' => 'value',
                    'type' => 'number',
                    'value' => $analysis->value,
                    'modifier' => 'required',
                ])

                <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">

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

@foreach($analyses as $analysis)
<div class="modal fade" id="show{{ $analysis->id }}" tabindex="-1" analysis="dialog" aria-labelledby="show{{ $analysis->id }}Label" aria-hidden="true">
    <div class="modal-dialog" analysis="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show{{ $analysis->id }}Label">Info {{ ucfirst('analisa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                @include('components.input',[
                    'label' => 'Created',
                    'name' => 'created_at',
                    'type' => 'text',
                    'value' => $analysis->created_at,
                    'modifier' => 'readonly',
                ])

                @include('components.input',[
                    'label' => 'Updated',
                    'name' => 'updated_at',
                    'type' => 'text',
                    'value' => $analysis->created_at,
                    'modifier' => 'readonly',
                ])

                @include('components.input',[
                    'label' => 'User',
                    'name' => 'user',
                    'type' => 'text',
                    'value' => $analysis->user->name,
                    'modifier' => 'readonly',
                ])

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endforeach

{{--
@foreach($analysiss as $analysis)
<div class="modal fade" id="delete{{ $analysis->id }}" tabindex="-1" analysis="dialog" aria-labelledby="delete{{ $analysis->id }}Label" aria-hidden="true">
    <div class="modal-dialog" analysis="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $analysis->id }}Label">Hapus {{ ucfirst('analisa') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('analysiss.destroy', $analysis->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $analysis->material->name,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="material_id" value="{{ $analysis->material_id }}">
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
@endforeach --}}

@endsection

