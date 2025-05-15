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
                    <h4>Edit User</h4>
                    <p class="mb-0">Manajemen User</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit User</a></li>
                </ol>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nama User -->
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama user">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="Masukkan email">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password (Opsional)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password baru">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru">
                    </div>
                    
                    <!-- Level -->
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control @error('level') is-invalid @enderror" id="level" name="level" required>
                            <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="owner" {{ old('level', $user->level) == 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="bendahara" {{ old('level', $user->level) == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                        </select>
                        @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-light">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection