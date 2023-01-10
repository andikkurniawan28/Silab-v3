
<h5>{{ $material }}</h5>

<table border="1">
    <tr>
        <td>ID</td>
        <td>Time</td>
        @foreach($methods as $method)
            <td>{{ $method->indicator->name }}</td>
        @endforeach
        <td>Sampler</td>
        <td>Analis</td>
    </tr>
    @foreach ($samples as $sample)
    <tr>
        <td>{{ $sample->id }}</td>
        <td>{{ $sample->created_at }}</td>
            @foreach($methods as $method)
                <td>
                    @for($i=0; $i<count($sample->analysis); $i++)
                        @if($method->indicator_id == $sample->analysis[$i]->indicator_id)
                            {{ $sample->analysis[$i]->value }}
                        @endif
                    @endfor
                </td>
            @endforeach
        <td>{{ $sample->user->name }}</td>
        <td>{{ $sample->analysis[0]->user->name }}</td>
    </tr>
    @endforeach
</table>
