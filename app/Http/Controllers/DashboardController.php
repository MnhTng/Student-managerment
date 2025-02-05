<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Student;
use App\Models\CreditClass;
use App\Models\Subject;
use App\Models\Score;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->identifier;
        $student = Student::find($user);
        $credit_classes = CreditClass::where('msv', $user)->get();
        $subjects = Subject::find($credit_classes->pluck('subject_code'));
        $gpa = Score::selectRaw('AVG(score) as avg_score')->where('msv', Auth::user()->identifier)->get();

        $credits = Score::where('msv', Auth::user()->identifier)->get();
        $credit_sum = 0;
        foreach ($credits as $credit) {
            $credit_sum += $credit->subject->credit;
        }

        if ($gpa[0]->avg_score >= 9.0) {
            $gpa[0]->avg_score = 4.0;
        } elseif ($gpa[0]->avg_score >= 8.5) {
            $gpa[0]->avg_score = 3.7;
        } elseif ($gpa[0]->avg_score >= 8.0) {
            $gpa[0]->avg_score = 3.5;
        } elseif ($gpa[0]->avg_score >= 7.0) {
            $gpa[0]->avg_score = 3.0;
        } elseif ($gpa[0]->avg_score >= 6.5) {
            $gpa[0]->avg_score = 2.5;
        } elseif ($gpa[0]->avg_score >= 5.5) {
            $gpa[0]->avg_score = 2.0;
        } elseif ($gpa[0]->avg_score >= 5.0) {
            $gpa[0]->avg_score = 1.5;
        } elseif ($gpa[0]->avg_score >= 4.0) {
            $gpa[0]->avg_score = 1.0;
        } else {
            $gpa[] = 0.0;
        }

        return view('dashboard', compact('student', 'credit_classes', 'subjects', 'gpa', 'credit_sum'));
    }
}
