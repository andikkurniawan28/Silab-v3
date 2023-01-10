@foreach ($materials as $material)
<h5>{{ $material->name }}</h5>
<table border="1">

    <tr>
        <td>ID</td>
        <td>Time</td>
        @foreach($material->method as $method)
            <td>{{ $method->indicator->name }}</td>
        @endforeach
        <td>Sampler</td>
        <td>Analis</td>
    </tr>

    @foreach($material->sample as $sample)
    <tr>
        <td>{{ $sample->id }}</td>
        <td>{{ $sample->created_at }}</td>
        @foreach($material->method as $method)
        <td>
            @foreach($sample->analysis as $analysis)
                @if($analysis->indicator->id == $method->indicator_id)
                    {{ $analysis->value }}
                @endif
            @endforeach
        </td>
        @endforeach
        <td>{{ $sample->user->name }}</td>
        <td>{{ $sample->analysis[0]->user->name }}</td>

        @if($loop->iteration == 5)
            @break
        @endif
    </tr>
    @endforeach

</table>
@endforeach
