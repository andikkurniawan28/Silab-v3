@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="m-0 font-weight-bold text-primary">{{ $title }}</h4>
    </div>

    @if($message = Session::get('error'))
        @include('components.alert', ['message'=>$message, 'color'=>'danger'])
    @elseif($message = Session::get('success'))
        @include('components.alert', ['message'=>$message, 'color'=>'success'])
    @endif

    <!-- Content Row -->
    <div class="row">

        @foreach ($materials as $material)
        <div class="col-lg-6 mb-4">
            <div class="card bg-dark text-white text-xs shadow">
                <div class="card-body">
                    <div class="font-weight-bold text-light text-uppercase mb-1">
                        <a href="{{ route('sample_result', $material->id) }}" class="text-light">{{ $material->name }}</a>
                    </div>
                    <div class="table-responsive">
                        <table width="100%" class="table table-sm table-hovered text-light text-left">
                            <tr>
                                <td>ID</td>
                                <td>Time</td>
                                @foreach($material->method as $method)
                                    <td>{{ $method->indicator->name }}</td>
                                @endforeach
                            </tr>
                            @foreach($material->sample as $sample)
                            <tr>
                                <td>{{ $sample->id }}</td>
                                <td>{{ date('H:i', strtotime($sample->created_at)) }}</td>
                                @foreach($material->method as $method)
                                <td>
                                    @foreach($sample->analysis as $analysis)
                                        @if($analysis->indicator->id == $method->indicator_id)
                                            {{ $analysis->value }}
                                        @endif
                                    @endforeach
                                </td>
                                @endforeach

                                @if($loop->iteration == 5)
                                    @break
                                @endif
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection

