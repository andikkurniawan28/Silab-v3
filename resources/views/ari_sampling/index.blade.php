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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('sampling ARI') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Rit ID</td>
                            <td>Jenis</td>
                            <td>RFID</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ari_samplings as $ari_sampling)
                        <tr>
                            <td>{{ $ari_sampling->id }}</td>
                            <td>{{ $ari_sampling->created_at }}</td>
                            <td>{{ $ari_sampling->rit_id }}</td>
                            <td>{{ $ari_sampling->category }}</td>
                            <td>{{ $ari_sampling->rfid }}</td>
                            <td>{{ $ari_sampling->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $ari_sampling->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $ari_sampling->id }}">
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
            {{-- <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create">
                @include('components.icon', ['icon' => 'plus '])
                Tambah
            </button> --}}
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" ari_sampling="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" ari_sampling="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('sampling ARI') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('ari_samplings.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @include('components.input',[
                    'label' => 'Rit ID',
                    'name' => 'rit_id',
                    'type' => 'text',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'RFID',
                    'name' => 'rfid',
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

@foreach($ari_samplings as $ari_sampling)
<div class="modal fade" id="edit{{ $ari_sampling->id }}" tabindex="-1" ari_sampling="dialog" aria-labelledby="edit{{ $ari_sampling->id }}Label" aria-hidden="true">
    <div class="modal-dialog" ari_sampling="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $ari_sampling->id }}Label">Edit {{ ucfirst('sampling ARI') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('ari_samplings.update', $ari_sampling->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                @include('components.input',[
                    'label' => 'Rit ID',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $ari_sampling->rit_id,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'RFID',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $ari_sampling->rfid,
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

@foreach($ari_samplings as $ari_sampling)
<div class="modal fade" id="delete{{ $ari_sampling->id }}" tabindex="-1" ari_sampling="dialog" aria-labelledby="delete{{ $ari_sampling->id }}Label" aria-hidden="true">
    <div class="modal-dialog" ari_sampling="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $ari_sampling->id }}Label">Hapus {{ ucfirst('sampling ARI') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('ari_samplings.destroy', $ari_sampling->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>

                @include('components.input',[
                    'label' => 'RFID',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $ari_sampling->rfid,
                    'modifier' => 'readonly',
                ])
                <input type="hidden" name="ari_sampling_id" value="{{ $ari_sampling->ari_sampling_id }}">
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

