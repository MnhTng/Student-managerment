<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'mgv',
        'name',
        'birthday',
        'gender',
        'address',
        'phone',
        'email',
        'created_at',
        'updated_at',
    ];

    protected $primaryKey = 'mgv';

    protected $keyType = 'string';

    public function formal_classes()
    {
        return $this->hasMany(FormalClass::class, 'mgv', 'mgv');
    }

    public function credit_classes()
    {
        return $this->hasMany(CreditClass::class, 'mgv', 'mgv');
    }
}