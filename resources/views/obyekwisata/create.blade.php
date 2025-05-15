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
                <h4 class="card-title">Form Tambah Obyek Wisata</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('obyekwisata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Nama Wisata</label>
                        <input type="text" name="nama_wisata" class="form-control @error('nama_wisata') is-invalid @enderror" value="{{ old('nama_wisata') }}" required>
                        @error('nama_wisata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Wisata</label>
                        <textarea name="deskripsi_wisata" class="form-control @error('deskripsi_wisata') is-invalid @enderror" rows="5" required>{{ old('deskripsi_wisata') }}</textarea>
                        @error('deskripsi_wisata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Kategori Wisata</label>
                        <select name="id_kategori_wisata" class="form-control @error('id_kategori_wisata') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach($kategoriWisatas as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('id_kategori_wisata') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->kategori_wisata }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_kategori_wisata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Fasilitas</label>
                        <textarea name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" rows="3" required>{{ old('fasilitas') }}</textarea>
                        @error('fasilitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Foto Wisata</label>
                        <div class="row">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="col-md-4 mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="foto{{ $i }}" class="form-control-file @error('foto'.$i) is-invalid @enderror">
                                        <label class="custom-file-label" for="foto{{$i}}">Pilih Foto {{ $i }}</label>
                                <!-- <input type="file" name="foto{{ $i }}" class="form-control-file @error('foto'.$i) is-invalid @enderror">
                            @error('foto'.$i)<div class="invalid-feedback">{{ $message }}</div>@enderror -->
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
            </div>
        </div>

        <div class="form-group text-right">
            <a href="{{ route('obyekwisata.index') }}" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection