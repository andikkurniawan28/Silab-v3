<table border="1">
    <tr>
        <td>ID</td>
        <td>Material</td>
        <td>Indicator</td>
        <td>Value</td>
        <td>User</td>
    </tr>
    @foreach ($analyses as $analysis)
    <tr>
        <td>{{ $analysis->id }}</td>
        <td>{{ $analysis->sample->material->name }}</td>
        <td>{{ $analysis->indicator->name }}</td>
        <td>{{ $analysis->value }}</td>
        <td>{{ $analysis->user->name }}</td>
    </tr>
    @endforeach
</table>
