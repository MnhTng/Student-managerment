<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormalClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_code',
        'mgv',
        'major_code',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'class_code';

    protected $keyType = 'string';

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_code', 'major_code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'mgv', 'mgv');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_code', 'class_code');
    }
}
