@extends('layouts.navbar1')

@section('content')
    <div class="container mt-4 p-4 bg-white rounded shadow">
        <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
            <h4>Edit Data Rombel</h4>
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('rombel.index')}}" style="color: black;">Data Rombel /</a> 
            <a href="{{route('rombel.create')}}" style="color: black;">Edit Data Rombel </a> 
          </div>
          <div class="mt-3">
            <form action="{{ route('rombel.update', $rombel['id']) }}" method="POST">
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
                    <label for="rombel" class="col-sm-2 col-form-label @error('rombel') is-invalid @enderror">Rombel :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombel['rombel'] }}">
                        @error('rombel')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection