@extends('layouts.navbar1')

@section('content')
 @if (Session::get('success'))
 <div class="alert alert-success">{{Session::get('success')}}</div>
 @endif

 @if (Session::get('deleted'))
 <div class="alert alert-warning">{{Session::get('deleted')}}</div>
 @endif
 
    <div class="jumbotron py-3 px-2">
        <h3>Data Rombel</h3>
        <a href="/dashboard" style="color: black;">Home /</a>
        <a href="{{route('rombel.index')}}" style="color: black;">Data Rombel </a>
        <hr class="my-1 mt-3">
    </div>

 <a href="{{ route('rombel.create') }}" class="btn btn-primary">Tambah Data</a>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Rombel</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no =1; @endphp
            @foreach($rombel as $item)
            <tr>
                <td>{{($no++)}}</td>
                <td>{{$item['rombel']}}</td>
                <td class="d-flex"> 
                    {{-- atau kalau path parameternya ada lebih dari satu : route ('rombel.edit',['param1' => $isi1, 'param2'=>isi2]) --}}
                    <a href="{{route('rombel.edit', $item['id']) }}" class="btn btn-primary">Edit</a>
                    <form action="{{route('rombel.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </td>
               
            </tr>
            @endforeach
          
        </tbody>
    </table>
    @endsection
    
