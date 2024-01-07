@extends('layouts.navbar1')

@section('content')
<div class="card mt-3">
    <div class="card-body p-5">
        <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
            <h4>Edit Data Siswa</h4>
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('user.index')}}" style="color: black;">Data Siswa /</a> 
            <a href="{{route('user.create')}}" style="color: black;">Edit Data Siswa </a> 
          </div>
          <div class="mt-3">
            <form action="{{ route('user.update', $user['id']) }}" method="POST">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Nama :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label @error('email') is-invalid @enderror">Email :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user['email'] }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="role" class="col-sm-2 col-form-label">Role :</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control">
                            <option selected hidden disabled>Pilih Role</option>
                            <option value="ps" {{ old('role', $user->role) == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label @error('password') is-invalid @enderror">Password :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="password" name="password" value="{{ $user['password'] }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection