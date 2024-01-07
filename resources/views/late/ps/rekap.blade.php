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
            <a href="{{route('ps.late.index')}}" style="color: black;">Data Keterlambatan/</a>
        </div>

        <a href="{{ route('ps.late.export-excel') }}" class="btn btn-info mb-3">Export Data Keterlambatan</a>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="{{route('ps.late.index')}}">Keseluruhan Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('ps.late.rekap')}}">Rekapitulasi Data</a>
        </li>
      </ul>


    <form class="mt-3" action="{{ route('ps.late.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{ request('student_id') }}" placeholder="Search Data Keterlambatan">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
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
                        <td><a href="{{route('ps.late.show', ['id'])}}" >Lihat</a> </td>
                        @if($item->total_late >= 3)
                        <td><a href="{{ route('ps.late.download',['id']) }}" class="btn btn-primary"> Cetak Surat Pernyataan</a></td>
                        @endif
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection