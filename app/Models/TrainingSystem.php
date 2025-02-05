<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_code',
        'training_name',
    ];

    protected $primaryKey = 'training_code';

    protected $keyType = 'string';

    public function students()
    {
        return $this->hasMany(Student::class, 'training_code', 'training_code');
    }
}
