@extends('layouts.navbar1')

@section('content')
    <div class="container mt-4 p-4 bg-white rounded shadow">
        <div class="justify-content-start jumbotron py-3" style="line-height: 5px; padding-bottom:30px;">
            <h4>Edit Data Siswa</h4>
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('admin.student.data')}}" style="color: black;">Data Siswa /</a> 
            <a href="{{route('admin.student.create')}}" style="color: black;">Edit Data Siswa </a> 
          </div>
          <div class="mt-3">
            <form action="{{ route('admin.student.update', $student['id']) }}" method="POST">
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
                    <label for="nis" class="col-sm-2 col-form-label @error('nis') is-invalid @enderror">Nis :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nis" name="nis" value="{{ $student['nis'] }}">
                        @error('nis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Nama :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $student['name'] }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="rombel_id" class="col-sm-2 col-form-label">Rombel :</label>
                    <div class="col-sm-10">
                        <select name="rombel_id" id="rombel_id" class="form-select">
                            <option selected disabled>Pilih Rombel</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ $rombel->id == $student->rombel_id ? 'selected' : '' }}>
                                    {{ $rombel->rombel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="rayon_id" class="col-sm-2 col-form-label">Rayon :</label>
                    <div class="col-sm-10">
                        <select name="rayon_id" id="rayon_id" class="form-select">
                            <option selected disabled>Pilih Rayon</option>
                            @foreach ($rayons as $rayon)
                                <option value="{{ $rayon->id }}" {{ $rayon->id == $student->rayon_id ? 'selected' : '' }}>
                                    {{ $rayon->rayon }}
                                </option>
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