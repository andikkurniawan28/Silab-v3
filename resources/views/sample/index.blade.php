<table border="1">
    <tr>
        <td>ID</td>
        <td>Station</td>
        <td>Material</td>
        <td>Parameter</td>
        <td>User</td>
    </tr>
    @foreach ($samples as $sample)
    <tr>
        <td>{{ $sample->id }}</td>
        <td>{{ $sample->material->name }}</td>
        <td>{{ $sample->material->station->name }}</td>
        <td>
            @foreach($sample->material->method as $method)
                <li>{{ $method->indicator->name }}</li>
            @endforeach
        </td>
        <td>{{ $sample->user->name }}</td>
    </tr>
    @endforeach
</table>
