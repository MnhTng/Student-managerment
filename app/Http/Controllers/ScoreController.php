<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Score;
use App\Models\SchoolYear;
use App\Models\Student;

class ScoreController extends Controller
{
    public function student()
    {
        $first_semester = range(7, 12);
        $second_semester = range(1, 6);

        $user = Auth::user()->identifier;
        if (in_array(Carbon::now()->month, $first_semester)) {
            $scores = Score::where('msv', $user)->where('school_year', Carbon::now()->year . '-' . Carbon::now()->year + 1 . '-' . 1)->get();
        } else {
            $scores = Score::where('msv', $user)->where('school_year', Carbon::now()->year . '-' . Carbon::now()->year + 1 . '-' . 2)->get();
        }

        $beginStudy = Str::of(Student::find($user)->academic_year)->explode('-')[0];
        $school_years = SchoolYear::where('school_term', '>=', $beginStudy . '-' . (int)$beginStudy + 1)
            ->where('school_term', '<=', Carbon::now()->year . '-' . Carbon::now()->year + 1)
            ->orderBy('slug', 'desc')
            ->get();
        if (Carbon::now()->month >= 7) {
            $school_years->shift();
        }

        if (Carbon::now()->month < 7) {
            $school_years->shift(2);
        }

        $gpa = [];
        $rank = [];

        foreach ($scores as $score) {
            if ($score->score >= 9.0) {
                $gpa[] = 4.0;
                $rank[] = 'A+';
            } elseif ($score->score >= 8.5) {
                $gpa[] = 3.7;
                $rank[] = 'A';
            } elseif ($score->score >= 8.0) {
                $gpa[] = 3.5;
                $rank[] = 'B+';
            } elseif ($score->score >= 7.0) {
                $gpa[] = 3.0;
                $rank[] = 'B';
            } elseif ($score->score >= 6.5) {
                $gpa[] = 2.5;
                $rank[] = 'C+';
            } elseif ($score->score >= 5.5) {
                $gpa[] = 2.0;
                $rank[] = 'C';
            } elseif ($score->score >= 5.0) {
                $gpa[] = 1.5;
                $rank[] = 'D+';
            } elseif ($score->score >= 4.0) {
                $gpa[] = 1.0;
                $rank[] = 'D';
            } else {
                $gpa[] = 0.0;
                $rank[] = 'F';
            }
        }

        $change_year = 0;
        return view('score', compact('scores', 'gpa', 'rank', 'school_years', 'change_year'));
    }

    public function changeSchoolYear(string $year)
    {
        sleep(2);

        return response()->json($year);
    }

    public function redirectStudentScore($year)
    {
        $user = Auth::user()->identifier;
        $scores = Score::where('msv', $user)->where('school_year', $year)->get();

        $beginStudy = Str::of(Student::find($user)->academic_year)->explode('-')[0];
        $school_years = SchoolYear::where('school_term', '>=', $beginStudy . '-' . (int)$beginStudy + 1)
            ->where('school_term', '<=', Carbon::now()->year . '-' . Carbon::now()->year + 1)
            ->orderBy('slug', 'desc')
            ->get();
        if (Carbon::now()->month >= 7) {
            $school_years->shift();
        }

        if (Carbon::now()->month < 7) {
            $school_years->shift(2);
        }

        $gpa = [];
        $rank = [];

        foreach ($scores as $score) {
            if ($score->score >= 9.0) {
                $gpa[] = 4.0;
                $rank[] = 'A+';
            } elseif ($score->score >= 8.5) {
                $gpa[] = 3.7;
                $rank[] = 'A';
            } elseif ($score->score >= 8.0) {
                $gpa[] = 3.5;
                $rank[] = 'B+';
            } elseif ($score->score >= 7.0) {
                $gpa[] = 3.0;
                $rank[] = 'B';
            } elseif ($score->score >= 6.5) {
                $gpa[] = 2.5;
                $rank[] = 'C+';
            } elseif ($score->score >= 5.5) {
                $gpa[] = 2.0;
                $rank[] = 'C';
            } elseif ($score->score >= 5.0) {
                $gpa[] = 1.5;
                $rank[] = 'D+';
            } elseif ($score->score >= 4.0) {
                $gpa[] = 1.0;
                $rank[] = 'D';
            } else {
                $gpa[] = 0.0;
                $rank[] = 'F';
            }
        }

        $change_year = 1;
        return view('score', compact('year', 'scores', 'gpa', 'rank', 'school_years', 'change_year'));
    }
}
