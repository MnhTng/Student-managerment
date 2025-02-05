<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'school_term',
        'slug'
    ];

    protected $primaryKey = 'slug';

    protected $keyType = 'string';

    public function credit_classes()
    {
        return $this->hasMany(CreditClass::class, 'school_year', 'slug');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'school_year', 'slug');
    }
}
