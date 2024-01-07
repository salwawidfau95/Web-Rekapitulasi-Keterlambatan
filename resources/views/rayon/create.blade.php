@extends('layouts.navbar1')

@section('content')
<form action="{{ route('rayon.store') }}" method="POST" >
  <div class="container mt-4 p-4 bg-white rounded shadow">
    @csrf
    <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
      <h4>Tambah Data Rayon</h4>
      <a href="/dashboard" style="color: black;">Home /</a>
      <a href="{{route('rayon.index')}}" style="color: black;">Data Rayon /</a> 
      <a href="{{route('rayon.create')}}" style="color: black;">Tambah Data Rayon </a> 
    </div>
    <div class="mt-3 mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-invalid @enderror">Rayon :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
          @error('rayon')
          <div class="text-danger">{{$message}}</div>
          @enderror
    </div>
    <div class="mt-3 mb-3 row">
        <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-invalid @enderror">Pembimbing Siswa :</label>
        <div class="col-sm-10">
          <select name="name" id="name" class="form-control">
            <option selected hidden disabled>Pilih</option>
            @foreach ($rayon as $item)
                <option value="{{$item['name']}}">{{$item['name']}}</option>
            @endforeach
          </select>
          @error('rayon')
          <div class="text-danger">{{$message}}</div>
          @enderror
    </div>
    <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>

@endsection