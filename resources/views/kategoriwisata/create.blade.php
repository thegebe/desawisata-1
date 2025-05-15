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
        <h4>Tambah Kategori Wisata</h4>
        <form action="{{ route('kategoriwisata.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategori_wisata">Kategori Wisata</label>
                <input type="text" name="kategori_wisata" id="kategori_wisata" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@endsection