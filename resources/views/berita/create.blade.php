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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Berita</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="berita">Konten</label>
                        <textarea name="berita" class="form-control @error('berita') is-invalid @enderror" rows="5" required>{{ old('berita') }}</textarea>
                        @error('berita')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_post">Tanggal Posting</label>
                        <input type="date" name="tgl_post" class="form-control @error('tgl_post') is-invalid @enderror" value="{{ old('tgl_post') }}" required>
                        @error('tgl_post')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="id_kategori_beritas">Kategori</label>
                        <select name="id_kategori_beritas" class="form-control @error('id_kategori_beritas') is-invalid @enderror" required>
                            @foreach($kategoriBeritas as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('id_kategori_beritas') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_berita }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_beritas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('berita.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection