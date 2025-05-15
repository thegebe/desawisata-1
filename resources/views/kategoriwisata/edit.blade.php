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
        <h4>Edit Kategori Wisata</h4>
        <form action="{{ route('kategoriwisata.update', $kategoriWisata->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori_wisata">Kategori Wisata</label>
                <input type="text" name="kategori_wisata" id="kategori_wisata" class="form-control" value="{{ $kategoriWisata->kategori_wisata }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection