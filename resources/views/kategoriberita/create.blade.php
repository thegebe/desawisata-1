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
        <h4>Tambah Kategori Berita</h4>
        <form action="{{ route('kategoriberita.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategori_berita">Kategori Berita</label>
                <input type="text" name="kategori_berita" id="kategori_berita" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
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