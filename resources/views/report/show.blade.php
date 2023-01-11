@foreach($data as $data)
    <h4>{{ $data['station'] }}</h4>
    <table border="1">
        <tr>
            <th>Material</th>
        </tr>
        @for($i=0; $i<count($data['station']['material']); $i++)
        <tr>
            <td>{{ $data['station']['material'][$i] }}</td>
        </tr>
        @endfor
    </table>
@endforeach
