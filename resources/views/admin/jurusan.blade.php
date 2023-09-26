@extends('layouts.admin')

@section('content')

<div class="row">

    <a href=""><button style="color: #f5f5f5; background-color: #F88105; width:100px; height: 50px; border: none; border-radius: 10px;">Add List</button></a>
</div>
<br>
<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Jurusan</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($jurusanList as $jurusan )

    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$student->id}}</td>
        <td>{{$student->nama}}</td>
      </tr>

    @endforeach

</table>

@endsection
