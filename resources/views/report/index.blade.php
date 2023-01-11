<form action="{{ route('process_report') }}" method="POST">
    @csrf
    @method('POST')
    <p><input type="date" name="date"></p>
    <p><input type="submit"></p>
</form>
