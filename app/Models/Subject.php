<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_name',
        'credit',
    ];

    protected $primaryKey = 'subject_code';

    protected $keyType = 'string';

    public function credit_classes()
    {
        return $this->hasMany(CreditClass::class, 'subject_code', 'subject_code');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'subject_code', 'subject_code');
    }
}
