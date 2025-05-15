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
                    <h4>Tambah Reservasi</h4>
                    <p class="mb-0">Form untuk menambahkan data reservasi</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('reservasi.index') }}">Reservasi</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Reservasi</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Tambah Reservasi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="id_pelanggan">Pelanggan</label>
                        <select name="id_pelanggan" id="id_pelanggan" class="form-control">
                            @foreach ($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_lengkap }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_paket">Paket Wisata</label>
                        <select name="id_paket" id="id_paket" class="form-control">
                            @foreach ($paketWisatas as $paket)
                                <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tgl_reservasi_wisata">Tanggal Reservasi</label>
                        <input type="date" name="tgl_reservasi_wisata" id="tgl_reservasi_wisata" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file_bukti_tf">Upload Bukti Transfer</label>
                        <input type="file" name="file_bukti_tf" id="file_bukti_tf" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection