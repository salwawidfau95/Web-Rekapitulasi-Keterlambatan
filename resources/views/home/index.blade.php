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
            <!-- Rombel Card -->
            <div class="col-md-4 mb-4">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Rombel</h5>
                  <h1 class="card-text"style="font-size: 30px;">6</h1>
                </div>
              </div>
            </div>
          
            <!-- Peserta Didik Card -->
            <div class="col-md-4 mb-4">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Peserta Didik</h5>
                  <h1 class="card-text"style="font-size: 30px;">5</h1>
                </div>
              </div>
            </div>
          
            <!-- Rayon Card -->
            <div class="col-md-4 mb-4">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Rayon</h5>
                  <h1 class="card-text"style="font-size: 30px;">3</h1>
                </div>
              </div>
            </div>
          
            <!-- Administrator Card -->
            <div class="col-md-6 mb-4">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="card-title" style="font-size: 15px;">Administrator</h5>
                  <h1 class="card-text"style="font-size: 30px;">2</h1>
                </div>
              </div>
            </div>
          
            <!-- Pembimbing Siswa Card -->
            <div class="col-md-6 mb-4">
              <div class="card border shadow h-100 py-2">
                <div class="card-body">
                  <h5 class="text-prima">Pembimbing Siswa</h5>
                  <h1 class="card-text" style="font-size: 30px;">3</h1>
                </div>
              </div>
            </div>
          </div>
    </div>
    
@endsection
