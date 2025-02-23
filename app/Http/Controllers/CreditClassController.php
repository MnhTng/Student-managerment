<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\CreditClass;

class CreditClassController extends Controller
{
    public function teacher(string $locale = 'vi')
    {
        $first_semester = range(7, 12);
        $second_semester = range(1, 6);

        $user = Auth::user()->identifier;

        $distinct_class = CreditClass::select('room', 'mgv', 'subject_code', 'school_year', 'start_time', 'end_time')
            ->distinct()
            ->get();

        $credit_classes = array();
        if (in_array(Carbon::now()->month, $first_semester)) {
            foreach ($distinct_class as $class) {
                if ($class->mgv == $user && in_array(Carbon::parse($class->start_time)->month, $first_semester) &&  Carbon::now()->year == Carbon::parse($class->start_time)->year) {
                    $true_class = CreditClass::where('room', $class->room)
                        ->where('mgv', $class->mgv)
                        ->where('subject_code', $class->subject_code)
                        ->where('school_year', $class->school_year)
                        ->where('start_time', $class->start_time)
                        ->where('end_time', $class->end_time)
                        ->first();
                    $credit_classes[] = $true_class;
                }
            }
        } else {
            foreach ($distinct_class as $class) {
                if ($class->mgv == $user && in_array(Carbon::parse($class->start_time)->month, $second_semester) &&  Carbon::now()->year == Carbon::parse($class->start_time)->year) {
                    $true_class = CreditClass::where('room', $class->room)
                        ->where('mgv', $class->mgv)
                        ->where('subject_code', $class->subject_code)
                        ->where('school_year', $class->school_year)
                        ->where('start_time', $class->start_time)
                        ->where('end_time', $class->end_time)
                        ->first();
                    $credit_classes[] = $true_class;
                }
            }
        }

        return view('credit-class', compact('credit_classes'));
    }

    public function student(string $locale = 'vi')
    {
        $first_semester = range(7, 12);
        $second_semester = range(1, 6);

        $user = Auth::user()->identifier;
        if (in_array(Carbon::now()->month, $first_semester)) {
            $credit_classes = CreditClass::where('msv', $user)->whereYear('start_time', Carbon::now()->year)->whereIn(DB::raw('MONTH(start_time)'), $first_semester)->orderBy('start_time', 'asc')->get();
        } else {
            $credit_classes = CreditClass::where('msv', $user)->whereYear('start_time', Carbon::now()->year)->whereIn(DB::raw('MONTH(start_time)'), $second_semester)->orderBy('start_time', 'asc')->get();
        }

        return view('credit-class', compact('credit_classes'));
    }
}
