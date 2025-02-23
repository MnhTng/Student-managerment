<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Score;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\CreditClass;
use App\Models\Teacher;
use App\Models\FormalClass;
use App\Models\Subject;
use App\Models\Major;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('admin') && !Gate::allows('teacher'))
            abort(403);
    }

    public function index(string $locale = 'vi')
    {
        $facultyNum = Faculty::count();
        $formal_classNum = FormalClass::count();
        $studentNum = Student::count();
        $teacherNum = Teacher::count();
        $subjectNum = Subject::count();

        $avgScores = Score::selectRaw('msv, AVG(score) as avg_score')->groupBy('msv')->orderBy('avg_score', 'desc')->limit(10)->get();

        $rankScores = Score::selectRaw('msv, AVG(score) as avg_score')->groupBy('msv')->orderBy('avg_score', 'desc')->get();
        $gpa = [];
        $rank = [];
        $chart = [
            'A_plus' => 0,
            'A_nor' => 0,
            'B_plus' => 0,
            'B_nor' => 0,
            'C_plus' => 0,
            'C_nor' => 0,
            'D_plus' => 0,
            'D_nor' => 0,
            'F_nor' => 0
        ];

        foreach ($rankScores as $avgScore) {
            if ($avgScore->avg_score >= 9.0) {
                $gpa[] = 4.0;
                $rank[] = 'A+';
                $chart['A_plus']++;
            } elseif ($avgScore->avg_score >= 8.5) {
                $gpa[] = 3.7;
                $rank[] = 'A';
                $chart['A_nor']++;
            } elseif ($avgScore->avg_score >= 8.0) {
                $gpa[] = 3.5;
                $rank[] = 'B+';
                $chart['B_plus']++;
            } elseif ($avgScore->avg_score >= 7.0) {
                $gpa[] = 3.0;
                $rank[] = 'B';
                $chart['B_nor']++;
            } elseif ($avgScore->avg_score >= 6.5) {
                $gpa[] = 2.5;
                $rank[] = 'C+';
                $chart['C_plus']++;
            } elseif ($avgScore->avg_score >= 5.5) {
                $gpa[] = 2.0;
                $rank[] = 'C';
                $chart['C_nor']++;
            } elseif ($avgScore->avg_score >= 5.0) {
                $gpa[] = 1.5;
                $rank[] = 'D+';
                $chart['D_plus']++;
            } elseif ($avgScore->avg_score >= 4.0) {
                $gpa[] = 1.0;
                $rank[] = 'D';
                $chart['D_nor']++;
            } else {
                $gpa[] = 0.0;
                $rank[] = 'F';
                $chart['F_nor']++;
            }
        }

        // Pie Chart
        $maleStudent = Student::where('gender', 'Nam')->count();
        $femaleStudent = Student::where('gender', 'Nữ')->count();
        $chart['maleStudent'] = $maleStudent;
        $chart['femaleStudent'] = $femaleStudent;

        $maleTeacher = Teacher::where('gender', 'Nam')->count();
        $femaleTeacher = Teacher::where('gender', 'Nữ')->count();
        $chart['maleTeacher'] = $maleTeacher;
        $chart['femaleTeacher'] = $femaleTeacher;

        // Bar chart num major
        $chartFacultyName = [];
        $chartMajorNum = [];

        $faculties = Faculty::all();
        foreach ($faculties as $faculty) {
            $chartFacultyName[] = $faculty->faculty_name;
            $chartMajorNum[] = $faculty->majors->count();
        }

        // Bar chart num student
        $chartMajorName = [];
        $chartStudentNum = [];

        $majors = Major::all();
        foreach ($majors as $major) {
            $chartMajorName[] = $major->major_name;
            $chartStudentNum[] = $major->students->count();
        }

        // Calendar
        $user = Auth::user()->identifier;
        $credit_classes = CreditClass::where('mgv', $user)->get();
        $subjects = Subject::find($credit_classes->pluck('subject_code'));

        return view('admin.dashboard', compact('avgScores', 'gpa', 'rank', 'facultyNum', 'studentNum', 'teacherNum', 'formal_classNum', 'subjectNum', 'chart', 'chartMajorNum', 'chartFacultyName', 'chartStudentNum', 'chartStudentNum', 'chartMajorName', 'subjects', 'credit_classes'));
    }
}
