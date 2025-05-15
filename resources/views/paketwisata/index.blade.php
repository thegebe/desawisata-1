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
                    <h4>Daftar Paket Wisata</h4>
                    <p class="mb-0">Manajemen Paket Wisata</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('paketwisata.index') }}">Paket Wisata</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Paket Wisata</h4>
                <a href="{{ route('paketwisata.create') }}" class="btn btn-primary btn-sm float-right">Tambah Paket Wisata</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Fasilitas</th>
                                <th>Harga per Pack</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paketWisatas as $key => $paketWisata)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $paketWisata->nama_paket }}</td>
                                    <td>{{ $paketWisata->deskripsi }}</td>
                                    <td>{{ $paketWisata->fasilitas }}</td>
                                    <td>Rp {{ number_format($paketWisata->harga_per_pack, 0, ',', '.') }}</td>
                                    <td>
                                        @if($paketWisata->foto1)
                                            <img src="{{ asset('storage/' . $paketWisata->foto1) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        @if($paketWisata->foto2)
                                            <img src="{{ asset('storage/' . $paketWisata->foto2) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        @if($paketWisata->foto3)
                                            <img src="{{ asset('storage/' . $paketWisata->foto3) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        @if($paketWisata->foto4)
                                            <img src="{{ asset('storage/' . $paketWisata->foto4) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>
                                        @if($paketWisata->foto5)
                                            <img src="{{ asset('storage/' . $paketWisata->foto5) }}" alt="Foto" width="50">
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td width="150px">
                                        <a href="{{ route('paketwisata.edit', $paketWisata->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('paketwisata.destroy', $paketWisata->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data paket wisata</td>
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