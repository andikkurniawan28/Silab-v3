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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('certificate of Analysis') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Timestamp</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coas as $coa)
                        <tr>
                            <td>{{ $coa->id }}</td>
                            <td>{{ $coa->created_at }}</td>
                            <td>{{ $coa->certificate->name }}</td>
                            <td>
                                <a href="{{ route('coas.show', $coa->id) }}" type="button" class="btn btn-outline-info btn-sm">
                                    @include('components.icon', ['icon' => 'info '])
                                    Show
                                </a>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $coa->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $coa->id }}">
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

<div class="modal fade" id="create" tabindex="-1" coa="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" coa="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('certificate of Analysis') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('coas.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="certificate_id" class="col-sm-3 col-form-label">Jenis</label>
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

@foreach($coas as $coa)
<div class="modal fade" id="edit{{ $coa->id }}" tabindex="-1" coa="dialog" aria-labelledby="edit{{ $coa->id }}Label" aria-hidden="true">
    <div class="modal-dialog" coa="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $coa->id }}Label">Edit {{ ucfirst('certificate of Analysis') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('coas.update', $coa->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="certificate_id" class="col-sm-3 col-form-label">Sertifikat</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="certificate_id">
                            @foreach ($certificates as $certificate)
                                <option value="{{ $certificate->id }}"
                                @if($coa->certificate_id == $certificate->id)
                                {{ 'selected' }}
                                @endif
                                >
                                    {{ $certificate->name }}
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

@foreach($coas as $coa)
<div class="modal fade" id="delete{{ $coa->id }}" tabindex="-1" coa="dialog" aria-labelledby="delete{{ $coa->id }}Label" aria-hidden="true">
    <div class="modal-dialog" coa="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $coa->id }}Label">Hapus {{ ucfirst('certificate of Analysis') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('coas.destroy', $coa->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>
                <input type="hidden" name="coa_id" value="{{ $coa->coa_id }}">
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

