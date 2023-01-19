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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('titik Keliling') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Nama</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kspots as $kspot)
                        <tr>
                            <td>{{ $kspot->id }}</td>
                            <td>{{ $kspot->created_at }}</td>
                            <td>{{ $kspot->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $kspot->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $kspot->id }}">
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

<div class="modal fade" id="create" tabindex="-1" kspot="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" kspot="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('titik Keliling') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('kspots.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
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

@foreach($kspots as $kspot)
<div class="modal fade" id="edit{{ $kspot->id }}" tabindex="-1" kspot="dialog" aria-labelledby="edit{{ $kspot->id }}Label" aria-hidden="true">
    <div class="modal-dialog" kspot="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $kspot->id }}Label">Edit {{ ucfirst('titik Keliling') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('kspots.update', $kspot->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $kspot->name,
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

@foreach($kspots as $kspot)
<div class="modal fade" id="delete{{ $kspot->id }}" tabindex="-1" kspot="dialog" aria-labelledby="delete{{ $kspot->id }}Label" aria-hidden="true">
    <div class="modal-dialog" kspot="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $kspot->id }}Label">Hapus {{ ucfirst('titik Keliling') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('kspots.destroy', $kspot->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'Nama',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $kspot->name,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="kspot_id" value="{{ $kspot->kspot_id }}">
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

