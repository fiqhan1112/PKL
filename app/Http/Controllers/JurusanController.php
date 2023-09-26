<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Student;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.sekolah', ['StudentList' => $students]);
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('students.create', ['jurusans' => $jurusans]);
    }

    public function store(Request $request)
    {
        $student = Student::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            // Anda bisa menambahkan field lainnya
        ]);

        $student->jurusans()->sync($request->jurusans);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
