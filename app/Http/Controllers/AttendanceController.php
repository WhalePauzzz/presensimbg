<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('kelas')) {
            $kelas = Classes::findOrFail($request->kelas);

            $attendances = Attendance::with(['student', 'user'])
                ->whereHas('student', function ($query) use ($kelas) {
                    $query->where('id_kelas', $kelas->id);
                })
                ->get()
                ->groupBy('date');

            return view('attendance.show', compact('attendances', 'kelas'));
        }

        $kelasList = Classes::all();
        return view('attendance.index', compact('kelasList'));
    }

    public function show($id)
    {
        $kelas = Classes::findOrFail($id);

        $attendances = Attendance::with('student')
            ->whereHas('student', function ($query) use ($id) {
                $query->where('id_kelas', $id);
            })
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('date'); // Kelompokkan berdasarkan tanggal

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
                $foto = $attendanceData['foto_izin'];
                $fotoIzinPath = $foto->storeAs(
                    'attendance_photos',
                    time() . '_' . $foto->getClientOriginalName(),
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
                    'id_user' => Auth::id(), // <- ini penting
                ]
            );
        }        

        // Redirect to attendance.index with the selected class
        return redirect()->route('attendance.index', ['kelas' => $request->kelas])
                         ->with('success', 'Absensi berhasil disimpan.');
    }
}