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
    public function index(Request $request)
{
    $classes = Classes::all();

    $selectedDate = $request->input('date');
    $tanggalList = Mbg::select('date')->distinct()->orderBy('date', 'desc')->pluck('date');

    $mbgQuery = Mbg::query();

    if ($selectedDate) {
        $mbgQuery->where('date', $selectedDate);
    }

    $mbgs = $mbgQuery->paginate(10); 

    return view('mbgs.index', compact('classes', 'mbgs', 'tanggalList', 'selectedDate'));
}

    public function editByDate($date)
    {
        $classes = Classes::all();
        $mbgs = MBG::where('date', $date)->get()->keyBy('id_kelas');

        return view('mbgs.edit', compact('classes', 'mbgs', 'date'));
    }

    public function updateByDate(Request $request)
    {
        // Cegah error jika tidak ada perubahan yang dikirim
        if (!$request->has('mbgs') || empty($request->mbgs)) {
            return back()->with('error', '⚠️ Tidak ada perubahan yang disimpan. Silakan ubah minimal satu data.');
        }

        foreach ($request->mbgs as $id_kelas => $data) {
            $mbg = Mbg::where('date', $request->date)->where('id_kelas', $id_kelas)->first();
        
            if ($mbg) {
                $mbg->diambil = isset($data['diambil']) && $data['diambil'] == '1';
                $mbg->dikembalikan = isset($data['dikembalikan']) && $data['dikembalikan'] == '1';
        
                if (isset($data['foto'])) {
                    $fotoPath = $data['foto']->store('mbg_fotos', 'public');
                    $mbg->foto = $fotoPath;
                }
        
                $mbg->save();
            }
        }        

        return redirect()->route('mbgs.index')->with('success', '✅ Data MBG berhasil diperbarui.');
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
            $studentsInClass = Student::where('id_kelas', $class->id)->pluck('id');

            $total_siswa = count($studentsInClass);

            $absentCount = Attendance::where('date', $request->date)
                ->whereIn('id_siswa', $studentsInClass)
                ->where('keterangan', 'absent')
                ->count();

            $total_hadir = $total_siswa - $absentCount;


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
        dd($request->all);
        $classes = Classes::all();

        foreach ($classes as $class) {
            $studentsInClass = Student::where('id_kelas', $class->id)->pluck('id');

            $total_siswa = count($studentsInClass);

            $absentCount = Attendance::where('date', $request->date)
                ->whereIn('id_siswa', $studentsInClass)
                ->where('keterangan', 'absent')
                ->count();

            $total_hadir = $total_siswa - $absentCount;



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
