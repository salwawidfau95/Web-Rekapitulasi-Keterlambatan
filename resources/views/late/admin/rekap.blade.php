@extends('layouts.navbar1')

@section('content')
    @if (Session::get('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    
    <h3>Data Keterlambatan</h3>
        <div class="justify-content-start jumbotron py-1 mb-3" style="line-height: 5px; padding-bottom:30px;">
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('admin.late.data')}}" style="color: black;">Data Keterlambatan/</a>
        </div>

        <a href="{{ route('admin.late.create')}}" class="btn btn-primary mb-3">Tambah Data</a>
        <a href="{{ route('admin.late.export-excel2') }}" class="btn btn-info mb-3">Export Data Keterlambatan</a>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.late.data')}}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.late.rekap2')}}">Rekapitulasi Data</a>
        </li>
      </ul>


    <form class="mt-3" action="{{ route('admin.late.data') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{ request('student_id') }}" placeholder="Search Data Keterlambatan">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
                <button class="btn btn-secondary" type="submit">Clear</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah Keterlambatan</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $no =1; @endphp
                @foreach ($rekap as $item)
                    <tr style="text-align: center">
                        <td>{{ ($no++)}}</td>
                        <td>{{ $item['student']['nis'] }}</td>
                        <td>{{ $item['student']['name'] }}</td>
                        <td>{{ $item->total_late }}</td>
                        <td><a href="{{route('admin.late.show2', ['id'])}}">lihat</a></td>
                        @if($item->total_late >= 3)
                        <td><a href="{{ route('admin.late.download2',['id']) }}" class="btn btn-primary"> Cetak Surat Pernyataan</a></td>
                        @endif
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection