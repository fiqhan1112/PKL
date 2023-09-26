<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jurusan;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function sekolah()
    {
        $student = Student::all();
        return view('admin.sekolah', ['studentList' => $student]);
    }


//     public function create()
//     {
//         return view('admin.add');
//     }

//     public function store(Request $request)
//     {
//         $student = $request->validate([
//             'sekolah' => 'required|string|max:255',
//             'nama' => 'required|string|max:255',
//             'alamat' => 'required|string|max:255'
//         ]);

//         Student::create($student);

//         return redirect()->route('admin.sekolah')->with('success', 'Data telah ditambahkan!');
//     }

//     public function edit(Student $student)
// {
//     return view('admin.edit', ['student' => $student]);
// }

// public function update(Request $request, Student $student)
// {
//     $data = $request->validate([
//         'sekolah' => 'required|string|max:255',
//         'nama' => 'required|string|max:255',
//         'alamat' => 'required|string|max:255'
//     ]);

//     $student->update($data);

//     return redirect()->route('admin.sekolah')->with('success', 'Data siswa berhasil diperbarui!');
// }

// public function destroy(Student $student)
// {
//     $student->delete();
//     return redirect()->route('admin.sekolah')->with('success', 'Siswa berhasil dihapus!');
// }

// // Method untuk menampilkan siswa yang telah dihapus (soft delete)
// public function trashed()
// {
//     $students = Student::onlyTrashed()->get();
//     return view('admin.trashed_students', compact('students'));
// }

// // Method untuk mengembalikan siswa yang telah dihapus (soft delete)
// public function restore($id)
// {
//     $student = Student::onlyTrashed()->where('id', $id)->firstOrFail();
//     $student->restore();
//     return redirect()->route('admin.sekolah')->with('success', 'Siswa berhasil dikembalikan!');
// }

// // Method untuk menghapus siswa secara permanen
// public function forceDelete($id)
// {
//     $student = Student::onlyTrashed()->where('id', $id)->firstOrFail();
//     $student->forceDelete();
//     return redirect()->route('admin.trashed')->with('success', 'Siswa berhasil dihapus secara permanen!');
// }







public function create()
{
    $jurusans = Jurusan::all();
    return view('admin.add', ['jurusans' => $jurusans]);
}

public function store(Request $request)
{
    // Buat siswa terlebih dahulu
    $student = Student::create($request->all());

    // Sinkronkan jurusan yang dipilih dengan siswa yang baru dibuat
    $student->jurusans()->sync($request->jurusan);

    return redirect()->route('admin.sekolah')->with('success', 'Siswa berhasil ditambahkan!');
}

public function edit(Student $student)
{
    $jurusans = Jurusan::all();
    return view('admin.edit', ['student' => $student, 'jurusans' => $jurusans]);
}

public function update(Request $request, Student $student)
{
    $student->update($request->all());
    $student->jurusans()->sync($request->jurusans);
    return redirect()->route('admin.sekolah')->with('success', 'Siswa berhasil diperbarui!');
}

public function destroy(Student $student)
{
    $student->delete();
    return redirect()->route('admin.sekolah')->with('success', 'Siswa berhasil dihapus!');
}

public function getStudentDetail($id)
{
    $student = Student::with('jurusans')->find($id);
    if (!$student) {
        return response()->json(['error' => 'Data siswa tidak ditemukan.'], 404);
    }
    return response()->json($student);
}

}
