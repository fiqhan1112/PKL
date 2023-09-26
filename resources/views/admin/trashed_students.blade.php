@extends('layouts.admin')

@section('content')

@foreach($students as $student)
<!-- Tombol Restore -->
<form action="{{ route('students.restore', $student->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">Restore</button>
</form>

<!-- Tombol Hapus Permanen -->
<form action="{{ route('students.forceDelete', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini secara permanen?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Hapus Permanen</button>
</form>

@endforeach

@endsection
