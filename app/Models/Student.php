<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $table = 'students';
    protected $primaryKey = 'id_siswa'; 
    protected $fillable = ['nm_siswa'];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'id_siswa');
    }
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'id_kelas', 'id_kelas'); // Sesuaikan dengan database
    }
}