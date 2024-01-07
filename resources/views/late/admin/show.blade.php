@extends('layouts.navbar1')

@section('content')
    @if (Session::get('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    
    <h3>Data Keterlambatan</h3>
    <div class="justify-content-start jumbotron py-1 " style="line-height: 5px; padding-bottom:30px;">
        <a href="/dashboard" style="color: black;">Home /</a>
        <a href="{{route('admin.late.data')}}" style="color: black;">Data Keterlambatan/</a>
        <a href="{{route('admin.late.show2',['id'])}}" style="color: black;">Detail Data Keterlambatan/</a>
    </div>

    <div class="row">
        @php $no = 1; @endphp
        @foreach ($show as $item)
            <div class="col-lg-4">
                <div class="rounded shadow mt-4 p-4" style="height: 15em;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Keterlambatan Ke-{{ ($no++) }}</h5>
                        <h6 class="card-subtitle text-muted">{{ $item['date_time_late'] }}</h6>
                        <h6 class="card-text" style="color: blue">{{ $item['information'] }}</h6>
                        <p class="card-text">
                            <img src="{{ asset('uploads/'.$item->bukti) }}" style="width: 80px" alt="">
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
