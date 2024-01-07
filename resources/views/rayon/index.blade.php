@extends('layouts.navbar1')

@section('content')
    <style>
        body {
            background-color: white;
            max-width: 100%;
            margin: 0 auto;
            overflow-x: hidden;
        }
    </style>

@if (Session::get('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
@if (Session::get('deleted'))
<div class="alert alert-warning">{{Session::get('deleted')}}</div>
@endif
<div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
    <h4>Data Rayon</h4>
    <a href="/dashboard" style="color: black;">Home /</a>
    <a href="{{route('rayon.index')}}" style="color: black;">Data Rayon </a>
</div>
<div class="container mt-4 p-4 bg-white rounded shadow">
<div class="container" style="max-width: 90%; margin: 0 50px 0 0 MB-5 ">
    <form action= {{ route('rayon.create') }} method="get">
        <button type="submit" class="btn btn-secondary float-end mb-4">Tambah Data</button>
    </form>
    <table class="table table-bordered mt-5" style="text-align: center;">
        <thead>
            <tr>
                <th>No</th>
                <th>Rayon</th>
                <th>Pembimbing Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rayon as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item['rayon'] }}</td>
                <td>{{ $item['User'] ? $item['User']['name'] : '' }}</td>
                <td class="d-flex">
                    <a style="margin-right: 0px;" href="{{route('rayon.edit', $item['id']) }}" class="btn btn-primary ml-5">Edit</a>
                    <form action="{{route('rayon.delete', $item['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button style="margin-right: -80px;" type="submit" class="btn btn-danger ml-5">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection