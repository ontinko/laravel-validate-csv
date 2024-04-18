<h2>Please upload your file below</h2>
<h3>When you upload a new file, the old one will get overwritten</h3>
<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input id="file" name="file" type="file">
    @error('file')
        <p>{{ $message }}</p>
    @enderror
    <button type="submit">Upload</button>
</form>
