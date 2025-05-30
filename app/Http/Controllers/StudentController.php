<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('classes')->get();
        $kelasList = \App\Models\Classes::all(); 

        return view('dashboard', compact('students', 'kelasList'));
    }
    
    public function create()
    {
        $kelasList = Classes::all(); 
        return view('students.create', compact('kelasList'));
    }


    public function show($id)
    {
        $kelas = Classes::with('students')->findOrFail($id);
        return view('students.show', compact('kelas'));
    }


    public function getByClass($id_kelas)
    {
        $students = Student::with('classes')->where('id_kelas', $id_kelas)->get();

        return response()->json($students);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nm_siswa' => 'required|string|max:255',
            'id_kelas' => 'required|exists:classes,id',
        ]);

        Student::create([
            'nm_siswa' => $request->nm_siswa,
            'id_kelas' => $request->id_kelas,
        ]);

        return redirect()->route('dashboard')->with('success', 'Siswa berhasil ditambahkan!');
    }
}
