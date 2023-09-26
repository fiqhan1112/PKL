<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = ['sekolah', 'nama', 'alamat'];

    protected $dates = ['deleted_at'];
    protected $table = 'students';

    public function jurusans()
{
    return $this->belongsToMany(Jurusan::class, 'student_jurusan');
}
}
