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
                    <h4>Edit Penginapan</h4>
                    <p class="mb-0">Perbarui data penginapan berikut</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Penginapan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Penginapan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('penginapan.update', $penginapan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Penginapan -->
                    <div class="form-group">
                        <label for="nama_penginapan">Nama Penginapan</label>
                        <input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" 
                               value="{{ old('nama_penginapan', $penginapan->nama_penginapan) }}" required 
                               placeholder="Masukkan nama penginapan">
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required 
                                  placeholder="Masukkan deskripsi penginapan">{{ old('deskripsi', $penginapan->deskripsi) }}</textarea>
                    </div>
                    
                    <!-- Fasilitas -->
                    <div class="form-group">
                        <label for="fasilitas">Fasilitas</label>
                        <textarea class="form-control" id="fasilitas" name="fasilitas" rows="5" required 
                                  placeholder="Masukkan fasilitas penginapan">{{ old('fasilitas', $penginapan->fasilitas) }}</textarea>
                    </div>
                    
                    <!-- Upload Foto -->
                    <div class="form-group">
                        <label>Foto Penginapan</label>
                        <div class="row">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="col-md-4 mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto{{$i}}" name="foto{{$i}}">
                                    <label class="custom-file-label" for="foto{{$i}}">Foto {{$i}}</label>
                                    @if($penginapan->{'foto'.$i})
                                        <div class="mt-2">
                                            <img src="{{ $penginapan->{'foto'.$i} }}" alt="Foto {{$i}}" style="max-width: 100px;">
                                            <small class="text-muted">Foto saat ini</small>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endfor
                        </div>
                        <small class="text-muted">Unggah maksimal 5 foto (Format: JPG/PNG, Maks 2MB per foto)</small>
                    </div>
                    
                    <div class="form-group text-right mt-4">
                        <a href="{{ route('penginapan.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Perbarui Data</button>
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