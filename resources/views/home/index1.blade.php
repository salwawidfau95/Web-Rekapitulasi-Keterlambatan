@extends('layouts.navbar1')

@section('content')
<div class="jumbotron py-5 px-3">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        <H4>Dashboard</H4> 
        <a href="/dashboard" style="color: black;">Home /</a>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 ">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Peserta Didik Rayon {{$rayon}}</h5>
                  <h1 class="card-text"style="font-size: 30px;">1</h1>
                </div>
              </div>
            </div>
          
            <div class="col-md-6 ">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Keterlambatan {{$rayon}} Hari ini</h5>
                  <h1 class="card-text"style="font-size: 30px;">{{$todayLateCount}}</h1>
                </div>
              </div>
            </div>
    </div>
@endsection
