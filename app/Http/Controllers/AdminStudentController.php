<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Student;
use App\Models\TrainingSystem;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\FormalClass;

class AdminStudentController extends Controller
{
    private $ethnicity;

    public function __construct()
    {
        $this->ethnicity = [
            'Kinh',
            'Tày',
            'Thái',
            'Mường',
            'Khơ Mú',
            'Nùng',
            "H'Mông",
            'Dao',
            'Ê Đê',
            'Ba Na',
            'Gia Rai',
            'Xơ Đăng',
            'Tà Ôi',
            'Chăm',
            'Khmer',
            'Hoa',
            'Co Tu',
            'Bru - Vân Kiều',
            'Thổ',
            'Mường',
            'Sán Dìu',
            'Sán Chay',
            'Chứt',
            "M'Nông",
            'Lào',
            'Ngái',
            'Hà Nhì',
            'La Hủ',
            'Lô Lô',
            'Si La',
            'Phù Lá',
            'Rơ Măm',
            'Ơ Đu',
            'Cống',
            'Ngãi',
            'Kháng',
            'Mạ',
            'Đan Lai',
            'Xo Dang',
            'Giẻ Triêng',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $locale = 'vi')
    {
        $students = Student::all();

        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        $ethnicity = $this->ethnicity;
        $training_systems = TrainingSystem::all();
        $faculties = Faculty::all();
        $majors = Major::all();
        $formal_classes = FormalClass::all();

        return view('admin.student.add', compact('ethnicity', 'training_systems', 'faculties', 'majors', 'formal_classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'msv' => 'required|string|max:10|regex:/^B[0-9]{2}DC[A-Za-z]{2}[0-9]{3}$/|unique:students,msv',
                'name' => 'required|string|max:100',
                'birthday' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:100',
                'phone' => 'required|string|max:15|regex:/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/|unique:students,phone',
                'email' => 'required|string|email|max:100|unique:students,email',
                'cccd' => 'required|string|max:12|regex:/^[0-9]{12}$/|unique:students,cccd',
                'ethnicity' => 'required|string',
                'training_system' => 'required|string',
                'faculty' => 'required|string',
                'major' => 'required|string',
                'formal_class' => 'required|string',
                'academic_year' => 'required|string|regex:/^[0-9]{4}-[0-9]{4}$/',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'msv.max' => __('The :attribute field must not exceed :max characters.'),
                'msv.regex' => __('The :attribute field is not in the correct format.'),
                'msv.unique' => __('The :attribute field already exists on the system.'),
                'name.max' => __('The :attribute field must not exceed :max characters.'),
                'birthday.date' => __('The :attribute field is not in the correct format.'),
                'address.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.regex' => __('The :attribute field is not in the correct format.'),
                'phone.unique' => __('The :attribute field already exists on the system.'),
                'email.email' => __('The :attribute field is not in the correct format.'),
                'email.max' => __('The :attribute field must not exceed :max characters.'),
                'email.unique' => __('The :attribute field already exists on the system.'),
                'cccd.max' => __('The :attribute field must not exceed :max characters.'),
                'cccd.regex' => __('The :attribute field is not in the correct format.'),
                'cccd.unique' => __('The :attribute field already exists on the system.'),
                'academic_year.regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'msv' => __('Student Code'),
                'name' => __('Name'),
                'birthday' => __('Birthday'),
                'gender' => __('Gender'),
                'address' => __('Address'),
                'phone' => __('Phone'),
                'email' => __('Email'),
                'cccd' => __('ID Card'),
                'ethnicity' => __('Ethnicity'),
                'training_system' => __('Training System'),
                'faculty' => __('Faculty'),
                'major' => __('Major'),
                'formal_class' => __('Formal Class'),
                'academic_year' => __('School Year'),
            ]
        );

        $input = array();
        $input['msv'] = Str::upper($request->msv);
        $input['name'] = Str::title(Str::of($request->name)->trim());
        $input['birthday'] = date('Y-m-d', strtotime($request->birthday));
        $input['gender'] = Str::ucfirst($request->gender);
        $input['address'] = Str::title(Str::of($request->address)->trim());
        $input['phone'] = Str::replace('-', '', $request->phone);
        $input['email'] = Str::lower(Str::of($request->email)->trim());
        $input['cccd'] = Str::upper($request->cccd);
        $input['ethnicity'] = Str::ucfirst($request->ethnicity);
        $input['class_code'] = $request->formal_class;
        $input['faculty_code'] = $request->faculty;
        $input['major_code'] = $request->major;
        $input['training_code'] = $request->training_system;
        $input['academic_year'] = $request->academic_year;

        Student::create($input);

        return Redirect::route('student.index')->with('success', __('Student added successfully.'));
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
    public function edit(string $locale = 'vi', string $code)
    {
        $student = Student::find($code);
        $ethnicity = $this->ethnicity;
        $training_systems = TrainingSystem::all();
        $faculties = Faculty::all();
        $majors = Major::all();
        $formal_classes = FormalClass::all();

        return view('admin.student.edit', compact('student', 'ethnicity', 'training_systems', 'faculties', 'majors', 'formal_classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'msv' => 'required|string|max:10|regex:/^B[0-9]{2}DC[A-Za-z]{2}[0-9]{3}$/|unique:students,msv,' . $code . ',msv',
                'name' => 'required|string|max:100',
                'birthday' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:100',
                'phone' => 'required|string|max:15|regex:/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/|unique:students,phone,' . $request->phone . ',phone',
                'email' => 'required|string|email|max:100|unique:students,email,' . $request->email . ',email',
                'cccd' => 'required|string|max:12|regex:/^[0-9]{12}$/|unique:students,cccd,' . $request->cccd . ',cccd',
                'ethnicity' => 'required|string',
                'training_system' => 'required|string',
                'faculty' => 'required|string',
                'major' => 'required|string',
                'formal_class' => 'required|string',
                'academic_year' => 'required|string|regex:/^[0-9]{4}-[0-9]{4}$/',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'msv.max' => __('The :attribute field must not exceed :max characters.'),
                'msv.regex' => __('The :attribute field is not in the correct format.'),
                'msv.unique' => __('The :attribute field already exists on the system.'),
                'name.max' => __('The :attribute field must not exceed :max characters.'),
                'birthday.date' => __('The :attribute field is not in the correct format.'),
                'address.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.regex' => __('The :attribute field is not in the correct format.'),
                'phone.unique' => __('The :attribute field already exists on the system.'),
                'email.email' => __('The :attribute field is not in the correct format.'),
                'email.max' => __('The :attribute field must not exceed :max characters.'),
                'email.unique' => __('The :attribute field already exists on the system.'),
                'cccd.max' => __('The :attribute field must not exceed :max characters.'),
                'cccd.regex' => __('The :attribute field is not in the correct format.'),
                'cccd.unique' => __('The :attribute field already exists on the system.'),
                'academic_year.regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'msv' => __('Student Code'),
                'name' => __('Name'),
                'birthday' => __('Birthday'),
                'gender' => __('Gender'),
                'address' => __('Address'),
                'phone' => __('Phone'),
                'email' => __('Email'),
                'cccd' => __('ID Card'),
                'ethnicity' => __('Ethnicity'),
                'training_system' => __('Training System'),
                'faculty' => __('Faculty'),
                'major' => __('Major'),
                'formal_class' => __('Formal Class'),
                'academic_year' => __('School Year'),
            ]
        );

        $student = Student::find($code);
        $student->msv = Str::upper($request->msv);
        $student->name = Str::title(Str::of($request->name)->trim());
        $student->birthday = date('Y-m-d', strtotime($request->birthday));
        $student->gender = Str::ucfirst($request->gender);
        $student->address = Str::title(Str::of($request->address)->trim());
        $student->phone = Str::replace('-', '', $request->phone);
        $student->email = Str::lower(Str::of($request->email)->trim());
        $student->cccd = Str::upper($request->cccd);
        $student->ethnicity = Str::ucfirst($request->ethnicity);
        $student->class_code = $request->formal_class;
        $student->faculty_code = $request->faculty;
        $student->major_code = $request->major;
        $student->training_code = $request->training_system;
        $student->academic_year = $request->academic_year;
        $student->save();

        return Redirect::route('student.index')->with('success', __('The student has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        Student::destroy($code);

        return Redirect::route('student.index')->with('success', __('Deleted student successfully.'));
    }

    public function getMajorByFaculty(string $locale = 'vi', string $faculty)
    {
        $majors = Major::where('faculty_code', $faculty)->get();

        return response()->json($majors);
    }

    public function getFormalClassByMajor(string $locale = 'vi', string $major)
    {
        $formal_classes = FormalClass::where('major_code', $major)->get();

        return response()->json($formal_classes);
    }
}