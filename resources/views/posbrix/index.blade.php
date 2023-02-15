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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('pos Brix') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            {{-- <td>Nopol</td> --}}
                            <td>E-SPTA</td>
                            <td>Brix</td>
                            <td>Status</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posbrixes as $posbrix)
                        <tr>
                            <td>{{ $posbrix->id }}</td>
                            <td>{{ $posbrix->created_at }}</td>
                            {{-- <td>{{ $posbrix->rit->nopol }}</td> --}}
                            <td>{{ $posbrix->spta }}</td>
                            <td>{{ $posbrix->brix }}</td>
                            <td>{{ $posbrix->is_accepted }}</td>

                            {{-- @if($posbrix->is_accepted == 1)
                                <td>{{ 'Diterima' }}</td>
                            @elseif($posbrix->is_accepted == 0)
                                <td>{{ 'Ditolak' }}</td>
                            @elseif($posbrix->is_accepted == NULL)
                                <td>{{ '-' }}</td>
                            @endif --}}

                            <td>{{ $posbrix->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $posbrix->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $posbrix->id }}">
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

{{-- <div class="modal fade" id="create" tabindex="-1" posbrix="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" posbrix="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('pos Brix') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('posbrixes.store') }}" class="text-dark">
                @csrf
                @method('POST')

                <div class="form-group row">
                    <label for="rit_id" class="col-sm-2 col-form-label">Nopol</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="rit_id">
                            @foreach ($rits as $rit)
                                <option value="{{ $rit->id }}">
                                    {{ $rit->nopol }} -- {{ $rit->barcode_antrian }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @include('components.input',[
                    'label' => 'Brix',
                    'name' => 'brix',
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

@foreach($posbrixes as $posbrix)
<div class="modal fade" id="edit{{ $posbrix->id }}" tabindex="-1" posbrix="dialog" aria-labelledby="edit{{ $posbrix->id }}Label" aria-hidden="true">
    <div class="modal-dialog" posbrix="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $posbrix->id }}Label">Edit {{ ucfirst('pos Brix') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('posbrixes.update', $posbrix->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                @include('components.input',[
                    'label' => 'Antrian',
                    'name' => 'rit_id',
                    'type' => 'text',
                    'value' => $posbrix->rit->barcode_antrian,
                    'modifier' => 'readonly',
                ])

                @include('components.input',[
                    'label' => 'Brix',
                    'name' => 'brix',
                    'type' => 'number',
                    'value' => $posbrix->brix,
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

@foreach($posbrixes as $posbrix)
<div class="modal fade" id="delete{{ $posbrix->id }}" tabindex="-1" posbrix="dialog" aria-labelledby="delete{{ $posbrix->id }}Label" aria-hidden="true">
    <div class="modal-dialog" posbrix="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $posbrix->id }}Label">Hapus {{ ucfirst('pos Brix') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('posbrixes.destroy', $posbrix->id) }}" class="text-dark">
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
@endforeach --}}

@endsection

