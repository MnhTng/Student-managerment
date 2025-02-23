<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\CreditClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\SchoolYear;
use App\Models\Subject;

class AdminCreditClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $locale = 'vi')
    {
        $distinct_class = CreditClass::select('room', 'mgv', 'subject_code', 'school_year', 'start_time', 'end_time')
            ->distinct()
            ->get();

        $credit_classes = array();
        foreach ($distinct_class as $class) {
            $credit_classes[] = CreditClass::where('room', $class->room)
                ->where('mgv', $class->mgv)
                ->where('subject_code', $class->subject_code)
                ->where('school_year', $class->school_year)
                ->where('start_time', $class->start_time)
                ->where('end_time', $class->end_time)
                ->first();
        }

        return view('admin.credit-class.index', compact('credit_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        $school_years = SchoolYear::all();
        $teachers = Teacher::all()->sortBy('name');
        $students = Student::all()->sortBy('name');
        $subjects = Subject::all()->sortBy('subject_name');

        return view('admin.credit-class.add', compact('school_years', 'teachers', 'students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'room' => 'required|min:5',
                'teacher' => 'required',
                'students' => 'required|array',
                'school_year' => 'required',
                'subject' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'min' => __('The :attribute field must have at least :min characters.'),
                'array' => __('The :attribute field must be an array.'),
            ],
            [
                'room' => __('Classroom'),
                'teacher' => __('Teacher'),
                'students' => __('Student'),
                'school_year' => __('School Year'),
                'subject' => __('Subject'),
                'start_time' => __('Start Time'),
                'end_time' => __('End Time'),
            ]
        );

        if (empty($request->students[0]['student']))
            return Redirect::back()->with('error', __('Please choose a student.'));

        $students_msv = [];
        foreach ($request->students as $student) {
            $parts = Str::of($student['student'])->explode('-')->count();
            if ($parts == 1)
                return Redirect::back()->with('error', __('Please enter full name and student code.'));

            $msv = Str::of($student['student'])->explode('-')[1];
            if (!(Student::find($msv)))
                return Redirect::back()->with('error', __('Student does not exist!'));

            if (!in_array(Str::upper($msv), $students_msv))
                $students_msv[] = Str::upper($msv);
        }

        $checkExists = CreditClass::where('room', Str::upper(Str::of($request->room)->trim()))
            ->where('mgv', $request->teacher)
            ->where('subject_code', $request->subject)
            ->where('school_year', $request->school_year)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->exists();
        if ($checkExists)
            return Redirect::back()->with('error', __('Credit classes already exist!'));

        foreach ($students_msv as $msv) {
            $input = [
                'room' => Str::upper(Str::of($request->room)->trim()),
                'msv' => Str::of($msv)->trim(),
                'mgv' => $request->teacher,
                'subject_code' => $request->subject,
                'school_year' => $request->school_year,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];

            CreditClass::create($input);
        }

        return Redirect::route('credit-class.index')->with('success', __('Credit class added successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale = 'vi', string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $locale = 'vi', string $class_id)
    {
        $classroom = CreditClass::find($class_id);
        $school_years = SchoolYear::all();
        $teachers = Teacher::all()->sortBy('name');
        $students = Student::all()->sortBy('name');
        $subjects = Subject::all()->sortBy('subject_name');

        return view('admin.credit-class.edit', compact('classroom', 'school_years', 'teachers', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $class_id)
    {
        $request->validate(
            [
                'room' => 'required|min:5',
                'teacher' => 'required',
                'school_year' => 'required',
                'subject' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'min' => __('The :attribute field must have at least :min characters.'),
                'array' => __('The :attribute field must be an array.'),
            ],
            [
                'room' => __('Classroom'),
                'teacher' => __('Teacher'),
                'school_year' => __('School Year'),
                'subject' => __('Subject'),
                'start_time' => __('Start Time'),
                'end_time' => __('End Time'),
            ]
        );

        $checkExists = CreditClass::where('room', Str::upper(Str::of($request->room)->trim()))
            ->where('mgv', $request->teacher)
            ->where('subject_code', $request->subject)
            ->where('school_year', $request->school_year)
            ->where('start_time', $request->start_time)
            ->where('end_time', $request->end_time)
            ->exists();
        if ($checkExists)
            return Redirect::back()->with('error', __('Credit classes already exist!'));

        $classroom = CreditClass::find($class_id);
        $credit_classes = CreditClass::where('room', $classroom->room)
            ->where('mgv', $classroom->mgv)
            ->where('subject_code', $classroom->subject_code)
            ->where('school_year', $classroom->school_year)
            ->where('start_time', $classroom->start_time)
            ->where('end_time', $classroom->end_time)
            ->get();

        foreach ($credit_classes as $credit_class) {
            $credit_class->room = Str::upper(Str::of($request->room)->trim());
            $credit_class->mgv = $request->teacher;
            $credit_class->subject_code = $request->subject;
            $credit_class->school_year = $request->school_year;
            $credit_class->start_time = $request->start_time;
            $credit_class->end_time = $request->end_time;
            $credit_class->save();
        }

        return Redirect::route('credit-class.index')->with('success', __('The credit class has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $class_id)
    {
        $credit_class = CreditClass::find($class_id);
        $classroom = CreditClass::where('room', $credit_class->room)
            ->where('mgv', $credit_class->mgv)
            ->where('subject_code', $credit_class->subject_code)
            ->where('school_year', $credit_class->school_year)
            ->where('start_time', $credit_class->start_time)
            ->where('end_time', $credit_class->end_time)
            ->get();

        foreach ($classroom as $class) {
            $class->delete();
        }

        return Redirect::route('credit-class.index')->with('success', __('Deleted credit class successfully.'));
    }

    public function list(string $locale = 'vi', string $class_id)
    {
        $credit_class = CreditClass::find($class_id);
        $classroom = CreditClass::where('room', $credit_class->room)
            ->where('mgv', $credit_class->mgv)
            ->where('subject_code', $credit_class->subject_code)
            ->where('school_year', $credit_class->school_year)
            ->where('start_time', $credit_class->start_time)
            ->where('end_time', $credit_class->end_time)
            ->get();

        return view('admin.credit-class.students.list', compact('credit_class', 'classroom'));
    }

    public function createStudent(string $locale = 'vi', string $class_id)
    {
        $classroom = CreditClass::find($class_id);
        $students = Student::all();

        return view('admin.credit-class.students.add', compact('classroom', 'students'));
    }

    public function storeStudent(Request $request, string $locale = 'vi', string $class_id)
    {
        $parts = Str::of($request->student)->explode('-')->count();

        if ($parts == 1)
            return Redirect::back()->with('error', __('Please enter full name and student code.'));

        $student_id = Str::of($request->student)->explode('-')[1];
        $student = Student::find($student_id);
        if (!$student)
            return Redirect::back()->with('error', __('Student does not exist!'));

        $classroom = CreditClass::find($class_id);

        $credit_class = CreditClass::where('room', $classroom->room)
            ->where('mgv', $classroom->mgv)
            ->where('subject_code', $classroom->subject_code)
            ->where('school_year', $classroom->school_year)
            ->where('start_time', $classroom->start_time)
            ->where('end_time', $classroom->end_time)
            ->where('msv', $student_id)
            ->exists();
        if ($credit_class)
            return Redirect::back()->with('error', __('Students already exist.'));

        $newStudent = $classroom;
        $newStudent->msv = $student_id;
        unset($newStudent->id);
        unset($newStudent->created_at);
        unset($newStudent->updated_at);

        CreditClass::create($newStudent->toArray());

        return Redirect::route('credit-class.list', [$class_id])->with('success', __('Student added to credit class successfully.'));
    }

    public function editStudent(string $locale = 'vi', string $class_id)
    {
        $classroom = CreditClass::find($class_id);
        $students = Student::all();

        return view('admin.credit-class.students.edit', compact('classroom', 'students'));
    }

    public function updateStudent(Request $request, string $locale = 'vi', string $class_id)
    {
        $parts = Str::of($request->student)->explode('-')->count();

        if ($parts == 1)
            return Redirect::back()->with('error', __('Please enter full name and student code.'));

        $student_id = Str::of($request->student)->explode('-')[1];
        $student = Student::find($student_id);
        if (!$student)
            return Redirect::back()->with('error', __('Student does not exist!'));

        $classroom = CreditClass::find($class_id);

        $credit_class = CreditClass::where('room', $classroom->room)
            ->where('mgv', $classroom->mgv)
            ->where('subject_code', $classroom->subject_code)
            ->where('school_year', $classroom->school_year)
            ->where('start_time', $classroom->start_time)
            ->where('end_time', $classroom->end_time)
            ->where('msv', $student_id)
            ->exists();
        if ($credit_class)
            return Redirect::back()->with('error', __('Students already exist.'));

        $classroom->msv = $student_id;
        $classroom->save();

        return Redirect::route('credit-class.list', [$class_id])->with('success', __('Student added to credit class successfully.'));
    }

    public function destroyStudent(string $locale = 'vi', string $class_id)
    {
        $credit_class = CreditClass::find($class_id);
        $numberStudent = CreditClass::where('room', $credit_class->room)
            ->where('mgv', $credit_class->mgv)
            ->where('subject_code', $credit_class->subject_code)
            ->where('school_year', $credit_class->school_year)
            ->where('start_time', $credit_class->start_time)
            ->where('end_time', $credit_class->end_time)
            ->count();

        if ($numberStudent == 1)
            return Redirect::back()->with('error', __('The last student in a credit class cannot be deleted.'));

        $classroom = CreditClass::where('id', '!=', $class_id)
            ->where('room', $credit_class->room)
            ->where('mgv', $credit_class->mgv)
            ->where('subject_code', $credit_class->subject_code)
            ->where('school_year', $credit_class->school_year)
            ->where('start_time', $credit_class->start_time)
            ->where('end_time', $credit_class->end_time)
            ->first();
        CreditClass::destroy($class_id);

        return Redirect::route('credit-class.list', [$classroom->id])->with('success', __('Successfully removed student from credit class.'));
    }
}
