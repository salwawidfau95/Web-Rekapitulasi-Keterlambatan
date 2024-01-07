@extends('layouts.navbar1')

@section('content')
<form action="{{ route('user.store') }}" method="POST">
  <div class="container mt-4 p-4 bg-white rounded shadow">
  <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
    <h4>Tambah Data User</h4>
    <a href="/dashboard" style="color: black;">Home /</a>
    <a href="{{route('user.index')}}" style="color: black;">Data User /</a> 
    <a href="{{route('user.create')}}" style="color: black;">Tambah Data User </a> 
  </div>
  
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
        
    @endif
@if (Session::get('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
     @endif @csrf

  <div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Nama:</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="name" name="name" value="{{ old('name') }}">
      @error('name')
      <div class="text-danger">{{$message}}</div>
          
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label ">Email:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email" value="{{ old('name') }}" >
      @error('email')
      <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
  </div>
  <div class="mb-3 row">
    <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna</label>
    <div class="col-sm-10">
       
        <select name="role" id="role" class="form-control">
            <option selected hidden disabled>Pilih</option>
            <option value="admin" {{ old('role') =='admin' ? 'selected' : ''}}>Admin</option>
            <option value="ps" {{ old('role') =='ps' ? 'selected' : ''}}>Pembimbing Rayon</option>
        </select>
        @error('role')
        <div class="text-danger">{{$message}}</div>
            
        @enderror
    </div>
  </div>
  

    <button type="submit" class="btn btn-primary">Kirim Data </button>
</form>
@endsection