<form action="/save" method="post">
    @csrf
    <input type="text" name="long_url" placeholder="Past Long URL">
    <button type="submit">Create Short URL</button>
</form>
