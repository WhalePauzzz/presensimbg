<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_siswa',
        'id_user',
        'date',
        'keterangan',
        'foto_izin',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_siswa', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function setFotoIzinAttribute($value)
    {
        $this->attributes['foto_izin'] = $value ?: 'noimage.png';
    }
}