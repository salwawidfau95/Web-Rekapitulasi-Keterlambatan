@extends('layouts.navbar1')

@section('content')

    <div class="mt-3">
        <h3 class="">Tambah Data Keterlambatan</h3>
        <div class="justify-content-start jumbotron py-1 mb-5" style="line-height: 5px; padding-bottom:30px;">
            <a href="/dashboard" style="color: black;">Home /</a>
            <a href="{{route('admin.late.data')}}" style="color: black;">Data Keterlambatan /</a>
            <a href="{{route('admin.late.create')}}" style="color: black;">Tambah Data</a>
        </div>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form action="{{ route('admin.late.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="student_id" class="col-sm-2 col-form-label @error('student_id') is-invalid @enderror">Siswa :</label>
                <div class="col-sm-10">
                    <select name="student_id" id="student_id" class="form-control">
                        <option selected hidden disabled>Pilih</option>
                        @foreach ($student as $late)
                            <option value="{{ $late->id }}">{{ $late->name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal :</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late" value="{{ old('date_time_lite') }}">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="ket_keterlambatan" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ket_keterlambatan" name="information" value="{{ old('information') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="bukti" class="col-sm-2 col-form-label">Pilih file:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="bukti" name="bukti">
                </div>
            </div>

            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    @if (Session::has('success') || Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if (Session::has('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ Session::get('success') }}',
                        confirmButtonText: 'OK'
                    });
                @elseif(Session::has('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ Session::get('error') }}',
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>
    @endif
@endsection

