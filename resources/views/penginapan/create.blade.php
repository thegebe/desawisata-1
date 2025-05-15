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
                    <h4>Tambah Penginapan Baru</h4>
                    <p class="mb-0">Isi form berikut untuk menambahkan data penginapan</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Penginapan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penginapan.store') }}" method="POST" enctype="multipart/form-data"> 
                    <!-- Form action untuk menyimpan data penginapan, pake function store dari controller -->
                    @csrf
                    
                    <!-- Nama Penginapan -->
                    <div class="form-group">
                        <label for="nama_penginapan">Nama Penginapan</label>
                        <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" required placeholder="Masukkan nama penginapan">
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required placeholder="Masukkan deskripsi penginapan"></textarea>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <textarea class="form-control" id="fasilitas" name="fasilitas" rows="5" required placeholder="Masukkan fasilitas penginapan"></textarea>
                    </div>
                    
                    <!-- Upload Foto -->
                    <div class="form-group">
                        <label>Foto Penginapan</label>
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
                        <a href="{{ route('penginapan.index') }}" class="btn btn-light">Batal</a>
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