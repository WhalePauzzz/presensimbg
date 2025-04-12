<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index()
    {
        $kelasList = Classes::all(); // Ambil semua kelas
        $attendances = Attendance::with('student.classes')->latest()->get();
        return view('attendance.index', compact('attendances', 'kelasList'));
    }

    public function show($id)
    {
        $kelas = Classes::findOrFail($id);

        $attendances = Attendance::with('student')
            ->whereHas('student', function ($query) use ($id) {
                $query->where('id_kelas', $id); // ini karena student punya field 'id_kelas'
            })
            ->get();

        return view('attendance.show', compact('kelas', 'attendances'));
    }

    public function getByClass($id)
    {
        $attendances = Attendance::with('student.classes')
            ->whereHas('student', function ($query) use ($id) {
                $query->where('id_kelas', $id);
            })->get();

        return response()->json($attendances);
    }


    public function create(Request $request)
    {
        $kelasList = Classes::all();
        $students = [];

        if ($request->has('kelas') && $request->kelas != '') {
            $students = Student::where('id_kelas', $request->kelas)->get();
        }
        
        return view('attendance.create', [
            'kelasList' => $kelasList,
            'students' => $students,
        ]);
    }
    public function getStudentsByClass($id_kelas)
    {
        $students = Student::where('id_kelas', $id_kelas)->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $request->validate([
            'attendance.*.date' => 'required|date',
            'attendance.*.keterangan' => 'required|in:present,absent',
            'attendance.*.foto_izin' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ],
    
        $messages = [
            'attendance.*.date.required' => 'Tanggal wajib diisi.',
            'attendance.*.keterangan.required' => 'Keterangan wajib dipilih.',
            'attendance.*.foto_izin.image' => 'File harus berupa gambar.',
            'attendance.*.foto_izin.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        foreach ($request->attendance as $studentId => $attendanceData) {
            $fotoIzinPath = 'noimage.png';
        
            if ($request->hasFile("attendance.$studentId.foto_izin")) {
                $fotoIzinPath = $attendanceData['foto_izin']->storeAs(
                    'attendance_photos',
                    time() . '_' . $attendanceData['foto_izin']->getClientOriginalName(),
                    'public'
                );
            }
        
            Attendance::updateOrCreate(
                [
                    'id_siswa' => $studentId,
                    'date' => $attendanceData['date'],
                ],
                [
                    'keterangan' => $attendanceData['keterangan'],
                    'foto_izin' => $fotoIzinPath,
                ]
            );
        }        

        // Redirect to attendance.index with the selected class
        return redirect()->route('attendance.index', ['kelas' => $request->kelas])
                         ->with('success', 'Absensi berhasil disimpan.');
    }
}