@extends('layouts.admin')

@section('content')

<h1>Edit Student</h1>

<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="sekolah">Sekolah:</label>
        <input type="text" id="sekolah" name="sekolah" value="{{ $student->sekolah }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ $student->nama }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="{{ $student->alamat }}" class="form-control">
    </div>
<select name="jurusans[]" multiple>
    @foreach($jurusans as $jurusan)
        <option value="{{ $jurusan->id }}" {{ in_array($jurusan->id, $student->jurusans->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $jurusan->name }}</option>
    @endforeach
</select>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.sekolah') }}" class="btn btn-default">Cancel</a>
    </div>

</form>

@endsection
