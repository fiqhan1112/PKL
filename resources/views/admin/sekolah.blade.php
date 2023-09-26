@extends('layouts.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// $(document).ready(function() {
//     $('#studentDetailModal').on('show.bs.modal', function(event) {
//         var button = $(event.relatedTarget);
//         var studentId = button.data('student-id');

//         $.get("{{ url('admin/student-detail') }}/" + studentId, function(data) {
//             var modal = $('#studentDetailModal');
//             modal.find('#modalStudentSekolah').text(data.sekolah);
//             modal.find('#modalStudentJurusan').text(data.jurusan);
//         });
//     });
// });
$(document).ready(function() {
    $('#studentDetailModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var studentId = button.data('student-id');

        $.get("{{ url('admin/student-detail') }}/" + studentId, function(data) {
            var modal = $('#studentDetailModal');
            modal.find('#modalStudentSekolah').text(data.sekolah);

            // Tampilkan semua jurusan yang terkait dengan siswa
            var jurusanList = data.jurusans.map(function(jurusan) {
                return jurusan.name;
            }).join(', ');

            modal.find('#modalStudentJurusan').text(jurusanList);
        });
    });
});


</script>


<div class="row">

    <a href="sekolah-add"><button style="color: #f5f5f5; background-color: #F88105; width:100px; height: 50px; border: none; border-radius: 10px;">Add List</button></a>
</div>
<br>
<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col"  style="text-align: center;">ID</th>
      <th scope="col"  style="text-align: center;">Sekolah/Universitas</th>
      <th scope="col"  style="text-align: center;">Nama</th>
      <th scope="col"  style="text-align: center;">Alamat</th>
      <th scope="col"  style="text-align: center;">Jurusan</th>
      <th scope="col" style="width: 340px; text-align: center;">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($studentList as $student )

    <tr>
        <td>{{$loop->iteration}}</td>
        <th>{{$student->sekolah}}</th>
        <td>{{$student->nama}}</td>
        <td>{{$student->alamat}}</td>
        <td>
            {{ implode(', ', $student->jurusans->pluck('name')->toArray()) }}
        </td>

        <td>
        {{-- <a href="{{ route('admin.student.detail', $student->id) }}"><button style="color: #f5f5f5; background-color: #F88105; width:100px; height: 50px; border: none; border-radius: 10px;" data-toggle="modal" data-target="studentDetailModalLabel">Detail</button></a> --}}
        <button style="color: #f5f5f5; background-color: #F88105; width:100px; height: 50px; border: none; border-radius: 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentDetailModal" data-student-id="{{ $student->id }}">Detail</button>
        <a href="{{ route('students.edit', $student->id) }}"><button style="color: #f5f5f5; background-color: #027a6a; width:100px; height: 50px; border: none; border-radius: 10px;">Edit</button></a>
        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
            @csrf
            @method('DELETE')
            <button style="color: #f5f5f5; background-color: #B0160c; width:100px; height: 50px; border: none; border-radius: 10px;">Delete</button>
        </form>
        </td>
      </tr>

    {{-- @endforeach --}}

    <div class="modal fade" id="studentDetailModal" tabindex="-1" role="dialog" aria-labelledby="studentDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="studentDetailModalLabel">Detail Siswa</h5>
                </div>
                <div class="modal-body">
                    <div class="pl-3 pr-3">
                        @if($student)
                    <p><strong>Sekolah/Universitas:</strong> <span id="modalStudentSekolah">{{ $student->sekolah }}</span></p>
                    <p><strong>Jurusan:</strong> <span id="modalStudentJurusan">   {{ implode(', ', $student->jurusans->pluck('name')->toArray()) }}</span></p>
                    @else
                    <p>Data siswa tidak ditemukan.</p>
                    @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</table>

@endsection
