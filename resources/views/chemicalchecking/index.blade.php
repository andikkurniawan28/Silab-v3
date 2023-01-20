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
            <h5 class="m-0 font-weight-bold text-primary">{{ ucfirst('Bahan Pembantu Proses') }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Timestamp</td>
                            <td>Data</td>
                            <td>Nama</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($chemicalcheckings as $chemicalchecking)
                        <tr>
                            <td>{{ $chemicalchecking->id }}</td>
                            <td>{{ $chemicalchecking->created_at }}</td>
                            <td>
                                @forelse($chemicalchecking->chemicalvalue as $value)
                                    <li>{{ $value->chemical->name }} : {{ $value->value }}</li>
                                @empty

                                @endforelse
                            </td>
                            <td>{{ $chemicalchecking->user->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $chemicalchecking->id }}">
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

<div class="modal fade" id="create" tabindex="-1" chemicalchecking="dialog" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" chemicalchecking="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Tambah {{ ucfirst('Bahan Pembantu Proses') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('chemicalcheckings.store') }}" class="text-dark">
                @csrf
                @method('POST')

                @foreach($chemicals as $chemical)

                    @include('components.input5',[
                        'label' => $chemical->name,
                        'name' => 'chemical'.$chemical->id,
                        'type' => 'number',
                        'value' => '',
                        'modifier' => '',
                    ])

                @endforeach

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

@foreach($chemicalcheckings as $chemicalchecking)
<div class="modal fade" id="delete{{ $chemicalchecking->id }}" tabindex="-1" chemicalchecking="dialog" aria-labelledby="delete{{ $chemicalchecking->id }}Label" aria-hidden="true">
    <div class="modal-dialog" chemicalchecking="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{ $chemicalchecking->id }}Label">Hapus {{ ucfirst('Bahan Pembantu Proses') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="{{ route('chemicalcheckings.destroy', $chemicalchecking->id) }}" class="text-dark">
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

