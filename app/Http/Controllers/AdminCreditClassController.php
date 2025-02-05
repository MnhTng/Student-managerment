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
    public function index()
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
    public function create()
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
    public function store(Request $request)
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
                'required' => 'Trường :attribute không được để trống.',
                'min' => 'Trường :attribute phải có ít nhất :min ký tự.',
                'array' => 'Trường :attribute phải là một mảng.',
            ],
            [
                'room' => 'phòng học',
                'teacher' => 'giảng viên',
                'students' => 'học sinh',
                'school_year' => 'năm học',
                'subject' => 'môn học',
                'start_time' => 'thời gian bắt đầu',
                'end_time' => 'thời gian kết thúc',
            ]
        );

        if (empty($request->students[0]['student']))
            return Redirect::back()->with('error', 'Vui lòng chọn sinh viên.');

        $students_msv = [];
        foreach ($request->students as $student) {
            $parts = Str::of($student['student'])->explode('-')->count();
            if ($parts == 1)
                return Redirect::back()->with('error', 'Vui lòng nhập đầy đủ Họ tên - Mã sinh viên.');

            $msv = Str::of($student['student'])->explode('-')[1];
            if (!(Student::find($msv)))
                return Redirect::back()->with('error', 'Sinh viên không tồn tại.');

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
            return Redirect::back()->with('error', 'Lớp tín chỉ đã tồn tại.');

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

        return Redirect::route('credit-class.index')->with('success', 'Thêm lớp tín chỉ thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $class_id)
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
    public function update(Request $request, string $class_id)
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
                'required' => 'Trường :attribute không được để trống.',
                'min' => 'Trường :attribute phải có ít nhất :min ký tự.',
                'array' => 'Trường :attribute phải là một mảng.',
            ],
            [
                'room' => 'phòng học',
                'teacher' => 'giảng viên',
                'school_year' => 'năm học',
                'subject' => 'môn học',
                'start_time' => 'thời gian bắt đầu',
                'end_time' => 'thời gian kết thúc',
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
            return Redirect::back()->with('error', 'Lớp tín chỉ đã tồn tại.');

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

        return Redirect::route('credit-class.index')->with('success', 'Cập nhật lớp tín chỉ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $class_id)
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

        return Redirect::route('credit-class.index')->with('success', 'Xóa lớp tín chỉ thành công.');
    }

    public function list(string $class_id)
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

    public function createStudent(string $class_id)
    {
        $classroom = CreditClass::find($class_id);
        $students = Student::all();

        return view('admin.credit-class.students.add', compact('classroom', 'students'));
    }

    public function storeStudent(Request $request, string $class_id)
    {
        $parts = Str::of($request->student)->explode('-')->count();

        if ($parts == 1)
            return Redirect::back()->with('error', 'Vui lòng nhập đầy đủ Họ tên - Mã sinh viên.');

        $student_id = Str::of($request->student)->explode('-')[1];
        $student = Student::find($student_id);
        if (!$student)
            return Redirect::back()->with('error', 'Sinh viên không tồn tại.');

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
            return Redirect::back()->with('error', 'Sinh viên đã tồn tại trong lớp tín chỉ.');

        $newStudent = $classroom;
        $newStudent->msv = $student_id;
        unset($newStudent->id);
        unset($newStudent->created_at);
        unset($newStudent->updated_at);

        CreditClass::create($newStudent->toArray());

        return Redirect::route('credit-class.list', $class_id)->with('success', 'Thêm sinh viên vào lớp tín chỉ thành công.');
    }

    public function editStudent(string $class_id)
    {
        $classroom = CreditClass::find($class_id);
        $students = Student::all();

        return view('admin.credit-class.students.edit', compact('classroom', 'students'));
    }

    public function updateStudent(Request $request, string $class_id)
    {
        $parts = Str::of($request->student)->explode('-')->count();

        if ($parts == 1)
            return Redirect::back()->with('error', 'Vui lòng nhập đầy đủ Họ tên - Mã sinh viên.');

        $student_id = Str::of($request->student)->explode('-')[1];
        $student = Student::find($student_id);
        if (!$student)
            return Redirect::back()->with('error', 'Sinh viên không tồn tại.');

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
            return Redirect::back()->with('error', 'Sinh viên đã tồn tại trong lớp tín chỉ.');

        $classroom->msv = $student_id;
        $classroom->save();

        return Redirect::route('credit-class.list', $class_id)->with('success', 'Thêm sinh viên vào lớp tín chỉ thành công.');
    }

    public function destroyStudent(string $class_id)
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
            return Redirect::back()->with('error', 'Không thể xóa sinh viên cuối cùng trong lớp tín chỉ.');

        $classroom = CreditClass::where('id', '!=', $class_id)
            ->where('room', $credit_class->room)
            ->where('mgv', $credit_class->mgv)
            ->where('subject_code', $credit_class->subject_code)
            ->where('school_year', $credit_class->school_year)
            ->where('start_time', $credit_class->start_time)
            ->where('end_time', $credit_class->end_time)
            ->first();
        CreditClass::destroy($class_id);

        return Redirect::route('credit-class.list', $classroom->id)->with('success', 'Xóa sinh viên khỏi lớp tín chỉ thành công.');
    }
}
