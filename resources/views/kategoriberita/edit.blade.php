@extends('be.master')
@section('navbar')
    @include('be.navbar')
@endsection
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <h4>Edit Kategori Berita</h4>
        <form action="{{ route('kategoriberita.update', $kategoriBerita->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori_berita">Kategori Berita</label>
                <input type="text" name="kategori_berita" id="kategori_berita" class="form-control" value="{{ $kategoriBerita->kategori_berita }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Custom script if needed
    });
</script>
@endsection
@section('footer')
    @include('be.footer')
@endsection