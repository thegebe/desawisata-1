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
                    <h4>Tambah Karyawan Baru</h4>
                    <p class="mb-0">Isi form berikut untuk menambahkan data karyawan</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Karyawan</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Karyawan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" name="nama_karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" value="{{ old('nama_karyawan') }}" required>
                        @error('nama_karyawan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat') }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            @foreach($jabatan as $item)
                                <option value="{{ $item }}" {{ old('jabatan') == $item ? 'selected' : '' }}>
                                    {{ ucfirst($item) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="id_user">User</label>
                        <select name="id_user" class="form-control @error('id_user') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
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