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
            <h5 class="m-0 font-weight-bold text-primary">{{ $material }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-dark table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Time</td>
                            @foreach($methods as $method)
                                <td>{{ $method->indicator->name }}</td>
                            @endforeach
                            @if($material_id >= 43 && $material_id <= 49 )
                                <td>Pan</td>
                                <td>Hl</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($samples as $sample)
                        <tr>
                            <td>{{ $sample->id }}</td>
                            <td>{{ $sample->created_at }}</td>
                                @foreach($methods as $method)
                                    <td>
                                        @foreach($sample->analysis as $analysis)
                                            @if($method->indicator_id == $analysis->indicator_id)
                                                {{ $analysis->value }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endforeach
                            @if($material_id >= 43 && $material_id <= 49 )
                                <td>{{ $sample->pan }}</td>
                                <td>{{ $sample->volume }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

