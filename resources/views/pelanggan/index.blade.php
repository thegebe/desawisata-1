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
                    <h4>Daftar Pelanggan</h4>
                    <p class="mb-0">Manajemen Pelanggan</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pelanggan</h4>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm float-right">Tambah Pelanggan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>User</th> <!-- Kolom baru untuk User -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $key => $pelanggan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $pelanggan->nama_lengkap }}</td>
                                    <td>{{ $pelanggan->no_hp }}</td>
                                    <td>{{ $pelanggan->alamat }}</td>
                                    <td>
                                        @if($pelanggan->foto)
                                            <img src="{{ asset('storage/' . $pelanggan->foto) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pelanggan->user ? $pelanggan->user->name : 'Tidak ada user' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data pelanggan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection