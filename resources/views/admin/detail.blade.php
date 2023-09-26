@extends('layouts.admin')

@section('content')

<h1>Detail of Student: {{ $student->nama }}</h1>

<table class="table table-bordered">
    <tr>
        <th>Sekolah</th>
        <td>{{ $student->sekolah }}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $student->nama }}</td>
    </tr>
    <tr>
        <th>Alamat</th>
        <td>{{ $student->alamat }}</td>
    </tr>
</table>

<a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('students.index') }}" class="btn btn-default">Back to List</a>

@endsection
