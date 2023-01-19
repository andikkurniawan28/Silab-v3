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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('balance Nira Mentah') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Tebu</td>
                            <td>Totalizer</td>
                            <td>Flow NM</td>
                            <td>NM % Tebu</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balances as $balance)
                        <tr>
                            <td>{{ $balance->id }}</td>
                            <td>{{ $balance->created_at }}</td>
                            <td>{{ $balance->tebu }}</td>
                            <td>{{ $balance->totalizer }}</td>
                            <td>{{ $balance->flow_nm }}</td>
                            <td>{{ $balance->nm_persen_tebu }}</td>
                            <td>{{ $balance->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $balance->id }}">
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

<div class="modal fade" id="create" tabindex="-1" balance="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" balance="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('balance Nira Mentah') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('balances.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @include('components.input',[
                    'label' => 'Tebu',
                    'name' => 'tebu',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Totalizer',
                    'name' => 'totalizer',
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

@foreach($balances as $balance)
<div class="modal fade" id="delete{{ $balance->id }}" tabindex="-1" balance="dialog" aria-labelledby="delete{{ $balance->id }}Label" aria-hidden="true">
    <div class="modal-dialog" balance="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $balance->id }}Label">Hapus {{ ucfirst('balance Nira Mentah') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('balances.destroy', $balance->id) }}" class="text-dark">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ?</p>
                <input type="hidden" name="balance_id" value="{{ $balance->balance_id }}">
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

