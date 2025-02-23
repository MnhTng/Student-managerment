<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WindowsAzure\ServiceManagement\Models\KeyType;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_code',
        'major_name',
        'faculty_code',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'major_code';

    protected $keyType = 'string';

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'faculty_code');
    }

    public function formal_classes()
    {
        return $this->hasMany(FormalClass::class, 'major_code', 'major_code');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'major_code', 'major_code');
    }
}
