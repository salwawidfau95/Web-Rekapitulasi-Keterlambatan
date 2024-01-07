@extends('layouts.navbar1')

@section('content')
<div class="card mt-3">
    <div class="card-body p-5">
        <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
            <h4>Edit Data Rayon</h4>
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('rayon.index')}}" style="color: black;">Data Rayon /</a> 
            <a href="{{route('rayon.create')}}" style="color: black;">Edit Data Rayon </a> 
          </div>
          <div class="mt-3">
            <form action="{{ route('rayon.update', $rayon['id']) }}" method="POST">
                @csrf
                @method('PATCH')
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (Session::get('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif

                <div class="mb-3 row">
                    <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-invalid @enderror">Rayon :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayon['rayon'] }}">
                        @error('rayon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pemb_siswa" class="col-sm-2 col-form-label">Pembimbing Siswa :</label>
                    <div class="col-sm-10">
                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $rayon['user_id']) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection