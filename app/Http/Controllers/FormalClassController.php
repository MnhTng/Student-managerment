<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\FormalClass;
use App\Models\Teacher;
use App\Models\Student;

class FormalClassController extends Controller
{
    public function teacher()
    {
        $user = Auth::user()->identifier;
        $class = FormalClass::where('mgv', $user)->orderBy('class_code', 'desc')->first();

        return view('formal-class', compact('class'));
    }

    public function student()
    {
        $user = Auth::user()->identifier;
        $class_code = Student::find($user)->formal_class->class_code;
        $class = FormalClass::find($class_code);

        return view('formal-class', compact('class'));
    }
}
