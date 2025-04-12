<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes'; 

    protected $primaryKey = 'id'; 
    
    protected $fillable = ['kelas', 'jurusan'];

    public $timestamps = false; 

    public function mbgs()
    {
        return $this->hasMany(Mbg::class, 'id_kelas', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'id_kelas', 'id');
    }
}