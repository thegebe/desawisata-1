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
                    <h4>Daftar Kategori Berita</h4>
                    <p class="mb-0">Manajemen Kategori Berita</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('kategoriberita.index') }}">Kategori Berita</a></li>
                </ol>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Kategori Berita</h4>
                <a href="{{ route('kategoriberita.create') }}" class="btn btn-primary btn-sm float-right">Tambah Kategori</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Kategori Berita</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategoriBeritas as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->kategori_berita }}</td>
                                    <td>
                                        <a href="{{ route('kategoriberita.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kategoriberita.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    @include('be.footer')
@endsection