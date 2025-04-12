<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mbg;
use App\Models\Classes;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class MbgController extends Controller
{
    public function index()
    {
        $classes = Classes::all();
        $mbgs = Mbg::where('date', now()->toDateString())->get();
        $tanggalList = Mbg::select('date')->distinct()->orderBy('date', 'desc')->pluck('date');

        return view('mbgs.index', compact('classes', 'mbgs', 'tanggalList'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('mbgs.create', compact('classes'));
    }

    public function inputFoto($id)
    {
        $mbg = Mbg::findOrFail($id);
        return view('mbgs.inputFoto', compact('mbg'));
    }

    public function storeFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $mbg = Mbg::findOrFail($id);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('mbg_photos', 'public');
            $mbg->update(['foto' => $fotoPath]);
        }

        return redirect()->route('mbgs.index')->with('success', 'Foto berhasil diperbarui');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:mbgs,id',
            'field' => 'required|in:diambil,dikembalikan',
            'status' => 'required|boolean',
        ]);

        $mbg = Mbg::findOrFail($request->id);
        $mbg->update([$request->field => $request->status]);

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }

    public function storeDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $classes = Classes::all();

        foreach ($classes as $class) {
            $total_siswa = Student::where('id_kelas', $class->id)->count();
            $total_hadir = Attendance::where('date', $request->date)
                ->whereIn('id_siswa', Student::where('id_kelas', $class->id)->pluck('id'))
                ->count();

            Mbg::updateOrCreate(
                [
                    'id_kelas' => $class->id,
                    'date' => $request->date,
                ],
                [
                    'total_siswa' => $total_siswa,
                    'total_hadir' => $total_hadir,
                    'diambil' => false,
                    'dikembalikan' => false,
                ]
            );
        }

        return redirect()->back()->with('success', 'Tanggal berhasil disimpan dan data diperbarui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $classes = Classes::all();

        foreach ($classes as $class) {
            $total_siswa = Student::where('id_kelas', $class->id)->count();
            $total_hadir = Attendance::where('date', $request->date)
                ->whereHas('student', function ($query) use ($class) {
                    $query->where('id_kelas', $class->id);
                })->count();

            Mbg::updateOrCreate(
                [
                    'id_kelas' => $class->id,
                    'date' => $request->date,
                ],
                [
                    'total_siswa' => $total_siswa,
                    'total_hadir' => $total_hadir,
                    'diambil' => false,
                    'dikembalikan' => false,
                ]
            );
        }

        return redirect()->route('mbgs.index')->with('success', 'Data berhasil diperbarui untuk semua kelas.');
    }
}
