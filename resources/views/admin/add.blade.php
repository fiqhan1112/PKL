@extends('layouts.admin')

@section('content')

<style>
    .heading-title {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form {
        max-width: 500px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    .form-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #d0d0d0;
        border-radius: 4px;
        background-color: #fff;
        transition: border 0.3s ease;
    }

    .form-input:focus {
        border-color: #007BFF;
        outline: none;
    }

    .error {
        display: block;
        margin-top: 5px;
        color: red;
        font-size: 12px;
    }

    .form-button {
        padding: 10px 20px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-button:hover {
        background-color: #0056b3;
    }
</style>

<form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data" class="form">
    @csrf
    <h4 class="heading-title">Add Student</h4>
    <div class="form-group">
        <label for="sekolah" class="form-label">Sekolah/Universitas</label>
        <input type="text" id="sekolah" name="sekolah" class="form-input" required>
    </div>
<div class="form-group">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukan nama Anda" required>
</div>
<div class="form-group">
    <label for="alamat" class="form-label">Alamat</label>
    <input type="text" id="alamat" name="alamat" class="form-input" placeholder="Masukan alamat Anda" required>
</div>
<div class="form-group">
    <label for="jurusan" class="form-label">Jurusan</label>
    <select  multiple name="jurusan[]" id="jurusan" class="form-input" required>
        @foreach($jurusans as $jurusan)
            <option value="{{ $jurusan->id }}">{{ $jurusan->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group-button">
    <button type="submit" class="form-button">Add</button>
</div>
</form>
@endsection
