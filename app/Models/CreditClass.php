<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'room',
        'start_time',
        'end_time',
        'mgv',
        'msv',
        'subject_code',
        'school_year',
        'created_at',
        'updated_at',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'mgv', 'mgv');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'msv', 'msv');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_code', 'subject_code');
    }

    public function school_years()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year', 'slug');
    }
}
