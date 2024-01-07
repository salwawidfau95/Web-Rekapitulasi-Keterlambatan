@extends('layouts.navbar1')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if (Session::get('deleted'))
        <div class="alert alert-warning">{{Session::get('deleted')}}</div>
        @endif
    <div class="jumbotron py-5 px-2">
        <h3>Data Siswa</h3>
        <a href="/dashboard" style="color: black;">Home /</a>
        <a href="{{route('admin.student.data')}}" style="color: black;">Data Siswa </a>
        <hr class="my-1">
    </div>

 <a href="{{ route('admin.student.create') }}" class="btn btn-primary">Tambah Data</a>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no =1; @endphp
            @foreach($student as $item)
            <tr>
                <td>{{($no++)}}</td>
                <td>{{$item['nis']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['rombel']['rombel']}}</td>
                <td>{{$item['rayon']['rayon']}}</td>
                <td class="d-flex"> 
                    <a href="{{route('admin.student.edit', $item['id']) }}" class="btn btn-primary">Edit</a>
                    <form action="{{route('admin.student.delete',$item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
          
                   <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </td>
               
            </tr>
            @endforeach
          
        </tbody>
    </table>
    </div>
    @endsection
    
