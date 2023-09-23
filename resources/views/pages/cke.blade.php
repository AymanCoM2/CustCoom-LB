<form action="{{ route('cke-post') }}" method="post">
    @csrf
    <input type="checkbox" name="OwnerIDExpiryDate_check">
    <input type="submit">
</form>
