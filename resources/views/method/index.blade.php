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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('metode') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Material</td>
                            <td>Indikator</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($methods as $method)
                        <tr>
                            <td>{{ $method->id }}</td>
                            <td>{{ $method->created_at }}</td>
                            <td>{{ $method->material->name }}</td>
                            <td>{{ $method->indicator->name }}</td>
                            <td>
                                <a href="{{ route('methods.edit', $method->id) }}" type="button" class="btn btn-outline-success btn-sm">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $method->id }}">
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

<div class="modal fade" id="create" tabindex="-1" method="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" method="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('metode') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('methods.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Material</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="material_id">
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

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

@foreach($methods as $method)
<div class="modal fade" id="delete{{ $method->id }}" tabindex="-1" method="dialog" aria-labelledby="delete{{ $method->id }}Label" aria-hidden="true">
    <div class="modal-dialog" method="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $method->id }}Label">Hapus {{ ucfirst('metode') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('methods.destroy', $method->id) }}" class="text-dark">
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

