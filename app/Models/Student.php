<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'msv',
        'name',
        'birthday',
        'gender',
        'address',
        'phone',
        'email',
        'cccd',
        'ethnicity',
        'class_code',
        'faculty_code',
        'major_code',
        'training_code',
        'academic_year',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'msv';

    protected $keyType = 'string';

    public function training_system()
    {
        return $this->belongsTo(TrainingSystem::class, 'training_code', 'training_code');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'faculty_code');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_code', 'major_code');
    }

    public function formal_class()
    {
        return $this->belongsTo(FormalClass::class, 'class_code', 'class_code');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'msv', 'msv');
    }

    public function credit_classes()
    {
        return $this->hasMany(CreditClass::class, 'msv', 'msv');
    }
}
