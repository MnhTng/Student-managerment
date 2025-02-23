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
    public function index(string $locale = 'vi')
    {
        $scores = Score::all();

        return view('admin.score.index', compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi', string $slug)
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
    public function store(Request $request, string $locale = 'vi', $credit_class)
    {
        $request->validate(
            [
                'score' => 'required|numeric|max:10|min:0',
            ],
            [
                'score.required' => __('The :attribute field cannot be empty.'),
                'score.numeric' => __('The :attribute field is not in the correct format.'),
                'score.max' => __('The :attribute field must not exceed :max characters.'),
                'score.min' => __('The :attribute field must have at least :min characters.'),
            ],
            [
                'score' => __('Score'),
            ]
        );

        $input = [
            'msv' => Str::of($request->student)->explode('-')[1],
            'subject_code' => $request->subject,
            'school_year' => $request->school_year,
            'score' => $request->score
        ];

        Score::create($input);

        return Redirect::route('score.show', [$credit_class])->with('success', __('The score has been updated successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale = 'vi', string $id)
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
        return view('admin.score.show', compact('credit_classes', 'scores', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $locale = 'vi', string $id)
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
    public function update(Request $request, string $locale = 'vi', string $id, string $credit_class)
    {
        $request->validate(
            [
                'score' => 'required|numeric|max:10|min:0',
            ],
            [
                'score.required' => __('The :attribute field cannot be empty.'),
                'score.numeric' => __('The :attribute field is not in the correct format.'),
                'score.max' => __('The :attribute field must not exceed :max characters.'),
                'score.min' => __('The :attribute field must have at least :min characters.'),
            ],
            [
                'score' => __('Score'),
            ]
        );

        $score = Score::find($id);
        $score->score = $request->score;
        $score->save();

        return Redirect::route('score.show', [$credit_class])->with('success', __('The score has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $id)
    {
        //
    }
}
