<form action="{{ route('report_process') }}" method="POST">
    @csrf
    @method('POST')
    <p>
        <select name="shift">
            <option value="0">Harian</option>
            <option value="1">Pagi</option>
            <option value="2">Sore</option>
            <option value="3">Malam</option>
        </select>
    </p>
    <p><input type="date" name="date" required></p>
    <p><input type="submit"></p>
</form>
