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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('analisa Rendemen') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Sample ID</td>
                            <td>%Brix</td>
                            <td>%Pol</td>
                            <td>Pol</td>
                            <td>Rend</td>
                            <td>User</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aris as $ari)
                        <tr>
                            <td>{{ $ari->id }}</td>
                            <td>{{ $ari->created_at }}</td>
                            <td>{{ $ari->ari_sampling_id }}</td>
                            <td>{{ $ari->pbrix }}</td>
                            <td>{{ $ari->ppol }}</td>
                            <td>{{ $ari->pol }}</td>
                            <td>{{ $ari->yield }}</td>
                            <td>{{ $ari->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#edit{{ $ari->id }}">
                                    @include('components.icon', ['icon' => 'edit '])
                                    Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $ari->id }}">
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

<div class="modal fade" id="create" tabindex="-1" ari="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" ari="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('analisa Rendemen') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('aris.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @include('components.input',[
                    'label' => 'Sample ID',
                    'name' => 'ari_sampling_id',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => '%Brix',
                    'name' => 'pbrix',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => '%Pol',
                    'name' => 'ppol',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Pol',
                    'name' => 'pol',
                    'type' => 'number',
                    'value' => '',
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Rend',
                    'name' => 'yield',
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

@foreach($aris as $ari)
<div class="modal fade" id="edit{{ $ari->id }}" tabindex="-1" ari="dialog" aria-labelledby="edit{{ $ari->id }}Label" aria-hidden="true">
    <div class="modal-dialog" ari="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit{{ $ari->id }}Label">Edit {{ ucfirst('analisa Rendemen') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('aris.update', $ari->id) }}" class="text-dark">
                @csrf
                @method('PUT')

                @include('components.input',[
                    'label' => 'Sample ID',
                    'name' => 'ari_sampling_id',
                    'type' => 'text',
                    'value' => $ari->ari_sampling_id,
                    'modifier' => 'readonly',
                ])

                @include('components.input',[
                    'label' => '%Brix',
                    'name' => 'pbrix',
                    'type' => 'number',
                    'value' => $ari->pbrix,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => '%Pol',
                    'name' => 'ppol',
                    'type' => 'number',
                    'value' => $ari->ppol,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Pol',
                    'name' => 'pol',
                    'type' => 'number',
                    'value' => $ari->pol,
                    'modifier' => 'required',
                ])

                @include('components.input',[
                    'label' => 'Rend',
                    'name' => 'yield',
                    'type' => 'number',
                    'value' => $ari->yield,
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

@foreach($aris as $ari)
<div class="modal fade" id="delete{{ $ari->id }}" tabindex="-1" ari="dialog" aria-labelledby="delete{{ $ari->id }}Label" aria-hidden="true">
    <div class="modal-dialog" ari="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $ari->id }}Label">Hapus {{ ucfirst('analisa Rendemen') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('aris.destroy', $ari->id) }}" class="text-dark">
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

