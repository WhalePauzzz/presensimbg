<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $table = 'students';
    protected $primaryKey = 'id_siswa'; 
    protected $fillable = ['nm_siswa', 'id_kelas'];

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'id_siswa', 'id_siswa');
    }
    
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'id_kelas', 'id');
    }
}
