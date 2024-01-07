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
        <a href="{{route('ps.student.index')}}" style="color: black;">Data Siswa </a>
        <hr class="my-1">
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php $no =1; @endphp
            @foreach($students as $item)
            <tr>
                <td>{{($no++)}}</td>
                <td>{{$item['nis']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['rombel']['rombel']}}</td>
                <td>{{$item['rayon']['rayon']}}</td>
            </tr>
            @endforeach
          
        </tbody>
    </table>
    </div>
    @endsection
    
