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
                <h4 class="card-title">Form Tambah Paket Wisata</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('paketwisata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror" value="{{ old('nama_paket') }}" required>
                        @error('nama_paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Fasilitas</label>
                        <textarea name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" rows="3" required>{{ old('fasilitas') }}</textarea>
                        @error('fasilitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Harga per Pack</label>
                        <input type="number" name="harga_per_pack" class="form-control @error('harga_per_pack') is-invalid @enderror" value="{{ old('harga_per_pack') }}" required>
                        @error('harga_per_pack')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Foto (Opsional)</label>
                        @for($i = 1; $i <= 5; $i++)
                            <div class="mb-2">
                                <input type="file" name="foto{{ $i }}" class="form-control-file @error('foto'.$i) is-invalid @enderror">
                                @error('foto'.$i)<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        @endfor
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('paketwisata.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection