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
                    <h4>Edit Karyawan</h4>
                    <p class="mb-0">Manajemen Karyawan</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('karyawan.index') }}">Karyawan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Karyawan</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Karyawan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama Karyawan -->
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror" id="nama_karyawan" name="nama_karyawan" value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" required placeholder="Masukkan nama karyawan">
                        @error('nama_karyawan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required placeholder="Masukkan alamat">{{ old('alamat', $karyawan->alamat) }}</textarea>
                        @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}" required placeholder="Masukkan nomor HP">
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" required>
                            @foreach($jabatan as $item)
                                <option value="{{ $item }}" {{ old('jabatan', $karyawan->jabatan) == $item ? 'selected' : '' }}>
                                    {{ ucfirst($item) }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- User -->
                    <div class="form-group">
                        <label for="id_user">User</label>
                        <select class="form-control @error('id_user') is-invalid @enderror" id="id_user" name="id_user" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user', $karyawan->id_user) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('id_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group text-right">
                        <a href="{{ route('karyawan.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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