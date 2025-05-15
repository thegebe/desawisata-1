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
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Obyek Wisata Baru</h4>
                    <p class="mb-0">Isi form berikut untuk menambahkan data obyek wisata</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('obyekwisata.index') }}">Obyek Wisata</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
                </ol>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Obyek Wisata</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('obyekwisata.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama_wisata">Nama Wisata</label>
                        <input type="text" class="form-control @error('nama_wisata') is-invalid @enderror" id="nama_wisata" name="nama_wisata" value="{{ old('nama_wisata') }}" required placeholder="Masukkan nama wisata">
                        @error('nama_wisata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi_wisata">Deskripsi Wisata</label>
                        <textarea class="form-control @error('deskripsi_wisata') is-invalid @enderror" id="deskripsi_wisata" name="deskripsi_wisata" rows="5" required placeholder="Masukkan deskripsi wisata">{{ old('deskripsi_wisata') }}</textarea>
                        @error('deskripsi_wisata')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="id_kategori_wisata">Kategori Wisata</label>
                        <select name="id_kategori_wisata" id="id_kategori_wisata" class="form-control @error('id_kategori_wisata') is-invalid @enderror" required>
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
                        <label for="fasilitas">Fasilitas</label>
                        <textarea class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas" rows="5" required placeholder="Masukkan fasilitas wisata">{{ old('fasilitas') }}</textarea>
                        @error('fasilitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Foto Obyek Wisata</label>
                        <div class="row">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="col-md-4 mb-3">
                                <div class="custom-file">
                                    <input type="file" id="foto{{$i}}" class="form-control-file @error('foto'.$i) is-invalid @enderror" name="foto{{$i}}" accept="image/*">
                                    <label class="custom-file-label" for="foto{{$i}}">Foto {{$i}}</label>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <small class="text-muted">Unggah maksimal 5 foto (Format: JPG/PNG, Maks 5MB per foto)</small>
                    </div>

                    <div class="form-group text-right mt-4">
                        <a href="{{ route('obyekwisata.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.form-control-file').forEach(function(input){
    input.addEventListener('change', function(e){
        let fileName = e.target.files[0] ? e.target.files[0].name : '';
        let label = e.target.nextElementSibling;
        if(label) label.innerText = fileName;
    });
});
</script>
@endsection
@section('footer')
    @include('be.footer')
@endsection