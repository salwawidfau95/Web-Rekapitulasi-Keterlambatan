@extends('layouts.navbar1')

@section('content')
<div class="container mt-4 p-4 bg-white rounded shadow">
<div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
  <h4>Tambah Data Siswa</h4>
  <a href="/dashboard" style="color: black;">Home /</a>
  <a href="{{route('admin.student.data')}}" style="color: black;">Data Siswa /</a> 
  <a href="{{route('admin.student.create')}}" style="color: black;">Tambah Data Siswa </a> 
</div>
    <form action="{{ route('admin.student.store')}}" class="card mt-3 p-5" method="POST">
        @if ($errors->any())
            <ul class="alert alert-dxanger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @csrf
        <div class="mb-3 row">
            <label for="nis" class="form-label">Nis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel" class="form-label">Rombel</label>
            <div class="col-sm-10">
                <select name="rombel" id="rombel" class="form-control">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($rombel as $item)              
                        <option value="{{ $item['rombel']}}">{{ $item['rombel']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rayon" class="form-label">Rayon</label>
            <div class="col-sm-10">
                <select name="rayon" id="rayon" class="form-control">
                    <option selected hidden disabled>Pilih</option>
                    @foreach ($rayon as $item)              
                        <option value="{{ $item['rayon']}}">{{ $item['rayon']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection