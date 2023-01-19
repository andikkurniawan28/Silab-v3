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
            <h5 class="m-0 font-weight-bold text-primary">Edit {{ ucfirst('metode') }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('methods.update', $method->id) }}" method="POST">
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="material_id">Material</label>
                    <select class="form-control" name="material_id">
                        @foreach ($materials as $material)
                            <option
                            @if($material->id == $method->material_id)
                            {{ 'selected' }}
                            @endif
                            value="{{ $material->id }}">
                            {{ $material->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="indicator_id">Indikator</label>
                    <select class="form-control" name="indicator_id">
                        @foreach ($indicators as $indicator)
                            <option
                            @if($indicator->id == $method->indicator_id)
                            {{ 'selected' }}
                            @endif
                            value="{{ $indicator->id }}">
                            {{ $indicator->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save
                        @include('components.icon', ['icon' => 'save'])
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@endsection

