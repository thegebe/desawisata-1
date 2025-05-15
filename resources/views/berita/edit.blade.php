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
                <h4 class="card-title">Form Edit Berita</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="berita">Konten</label>
                        <textarea name="berita" class="form-control @error('berita') is-invalid @enderror" rows="5" required>{{ old('berita', $berita->berita) }}</textarea>
                        @error('berita')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_post">Tanggal Posting</label>
                        <input type="date" name="tgl_post" class="form-control @error('tgl_post') is-invalid @enderror" value="{{ old('tgl_post', $berita->tgl_post) }}" required>
                        @error('tgl_post')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="id_kategori_berita">Kategori</label>
                        <select name="id_kategori_berita" class="form-control @error('id_kategori_berita') is-invalid @enderror" required>
                            @foreach($kategoriBeritas as $kategori)
                                <option value="{{ $kategori->id }}" {{ old('id_kategori_berita', $berita->id_kategori_berita) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->kategori_berita }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori_berita')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        @if($berita->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto" style="width: 100px;">
                            </div>
                        @endif
                        <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('berita.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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