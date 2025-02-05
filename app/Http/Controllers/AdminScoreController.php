<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Score;
use App\Models\CreditClass;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;

class AdminScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scores = Score::all();

        return view('admin.score.index', compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $slug)
    {
        $slug = Str::of($slug)->explode('-');

        $credit_class_id = $slug[0];
        $student = Student::find($slug[1]);
        $subject = Subject::find($slug[2]);
        $school_year = SchoolYear::find($slug[3] . '-' . $slug[4] . '-' . $slug[5]);

        return view('admin.score.add', compact('student', 'subject', 'school_year', 'credit_class_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $credit_class)
    {
        $request->validate(
            [
                'score' => 'required|numeric|max:10|min:0',
            ],
            [
                'score.required' => 'Vui lòng nhập điểm.',
                'score.numeric' => 'Điểm phải là số.',
                'score.max' => 'Điểm không được vượt quá 10.',
                'score.min' => 'Điểm không được nhỏ hơn 0.',
            ],
            [
                'score' => 'điểm',
            ]
        );

        $input = [
            'msv' => Str::of($request->student)->explode('-')[1],
            'subject_code' => $request->subject,
            'school_year' => $request->school_year,
            'score' => $request->score
        ];

        Score::create($input);

        return Redirect::route('score.show', $credit_class)->with('success', 'Cập nhật điểm thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = CreditClass::find($id);
        $credit_classes = CreditClass::where('room', $class->room)
            ->where('mgv', $class->mgv)
            ->where('subject_code', $class->subject_code)
            ->where('school_year', $class->school_year)
            ->where('start_time', $class->start_time)
            ->where('end_time', $class->end_time)
            ->get();
        $scores = Score::where('school_year', $class->school_year)
            ->where('subject_code', $class->subject_code)
            ->get();

        // return $scores->where('msv', 'B21DCKT004')->first()->score;
        return view('admin.score.show', compact('credit_classes', 'scores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slug = Str::of($id)->explode('-');
        $credit_class_id = $slug[0];
        $student_id = $slug[1];
        $score = Score::find($student_id);

        return view('admin.score.edit', compact('score', 'credit_class_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $credit_class)
    {
        $request->validate(
            [
                'score' => 'required|numeric|max:10|min:0',
            ],
            [
                'score.required' => 'Vui lòng nhập điểm.',
                'score.numeric' => 'Điểm phải là số.',
                'score.max' => 'Điểm không được vượt quá 10.',
                'score.min' => 'Điểm không được nhỏ hơn 0.',
            ],
            [
                'score' => 'điểm',
            ]
        );

        $score = Score::find($id);
        $score->score = $request->score;
        $score->save();

        return Redirect::route('score.show', $credit_class)->with('success', 'Cập nhật điểm thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
