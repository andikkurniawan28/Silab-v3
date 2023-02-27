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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('isi sertifikat') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Timestamp</th>
                            <th>Sertifikat</th>
                            <th>Material</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($certificate_contents as $certificate_content)
                        <tr>
                            <td>{{ $certificate_content->id }}</td>
                            <td>{{ $certificate_content->created_at }}</td>
                            <td>{{ $certificate_content->certificate->name }}</td>
                            <td>{{ $certificate_content->material->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $certificate_content->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $certificate_content->id }}">
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

<div class="modal fade" id="create" tabindex="-1" certificate_content="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" certificate_content="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('isi sertifikat') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('certificate_contents.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="certificate_id" class="col-sm-3 col-form-label">Sertifikat</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="certificate_id">
                            @foreach ($certificates as $certificate)
                                <option value="{{ $certificate->id }}">
                                    {{ $certificate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="material_id" class="col-sm-3 col-form-label">Material</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="material_id">
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">
                                    {{ $material->name }}
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

@foreach($certificate_contents as $certificate_content)
<div class="modal fade" id="edit{{ $certificate_content->id }}" tabindex="-1" certificate_content="dialog" aria-labelledby="edit{{ $certificate_content->id }}Label" aria-hidden="true">
    <div class="modal-dialog" certificate_content="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $certificate_content->id }}Label">Edit {{ ucfirst('isi sertifikat') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('certificate_contents.update', $certificate_content->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="certificate_id" class="col-sm-3 col-form-label">Sertifikat</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="certificate_id">
                            @foreach ($certificates as $certificate)
                                <option value="{{ $certificate->id }}"
                                @if($certificate_content->certificate_id == $certificate->id)
                                {{ 'selected' }}
                                @endif
                                >
                                    {{ $certificate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="material_id" class="col-sm-3 col-form-label">Material</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="material_id">
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}"
                                @if($certificate_content->material_id == $material->id)
                                {{ 'selected' }}
                                @endif
                                >
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

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

@foreach($certificate_contents as $certificate_content)
<div class="modal fade" id="delete{{ $certificate_content->id }}" tabindex="-1" certificate_content="dialog" aria-labelledby="delete{{ $certificate_content->id }}Label" aria-hidden="true">
    <div class="modal-dialog" certificate_content="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $certificate_content->id }}Label">Hapus {{ ucfirst('isi sertifikat') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('certificate_contents.destroy', $certificate_content->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $certificate_content->name,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="certificate_content_id" value="{{ $certificate_content->certificate_content_id }}">
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

