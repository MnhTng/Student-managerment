<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_code',
        'faculty_name',
        'created_at',
        'updated_at',
    ];

    //! Đặt 'faculty_code' là khóa chính
    protected $primaryKey = 'faculty_code';

    //! Nếu khóa chính không phải là kiểu 'integer', bạn cần chỉ định kiểu
    protected $keyType = 'string'; // Laravel không phân biệt kiểu CHAR, STRING, UUID, BINARY, VARBINARY, TINYTEXT, TEXT, MEDIUMTEXT, LONGTEXT, ENUM, DATE, TIME, DATETIME, TIMESTAMP, YEAR
    // protected $keyType = 'int'; // Laravel không phân biệt kiểu TINYINT, SMALLINT, MEDIUMINT, BIGINT, DECIMAL, FLOAT, DOUBLE, REAL, BIT, BOOLEAN, SERIAL
    // public $incrementing = true; //! Mặc định là true

    //! UUID (Chuỗi định danh duy nhất toàn cầu)
    // $table->uuid('uuid')->primary(); //! Đặt 'uuid' là khóa chính kiểu UUID
    // protected $keyType = 'string';
    // public $incrementing = false; //! Mặc định là false

    public function majors()
    {
        return $this->hasMany(Major::class, 'faculty_code', 'faculty_code');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'faculty_code', 'faculty_code');
    }
}
