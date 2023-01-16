<table border="1">
    <tr>
        <th>No</th>
        <th>Material</th>
        @foreach($indicators as $indicator)
            <th>{{ $indicator->name }}</th>
        @endforeach
    </tr>
    @foreach($data as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data['material'] }}</td>
        @foreach($indicators as $indicator)
            <td>
                @if (array_key_exists($indicator->name, $data))
                    {{ $data[$indicator->name] }}
                @else

                @endif
            </td>
        @endforeach
    </tr>
    @endforeach
</table>
