<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

use App\Models\FormalClass;
use App\Models\Major;
use App\Models\Teacher;

class AdminFormalClassController extends Controller
{
    public function __construct()
    {
        if (!Gate::allows('admin'))
            abort(403);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formal_classes = FormalClass::all();

        return view('admin.formal-class.index', compact('formal_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all()->sortBy('name');
        $majors = Major::all()->sortBy('major_name');

        return view('admin.formal-class.add', compact('teachers', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'class_code' => 'required|string|max:15|regex:/^D[0-9]{2}CQ[A-Za-z]{2}[0-9]{2}-B$/|unique:formal_classes,class_code',
                'major_code' => 'required',
                'mgv' => 'required',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'class_code.max' => 'Mã lớp không được vượt quá 15 ký tự.',
                'class_code.unique' => 'Mã lớp đã tồn tại trên hệ thống.',
                'class_code.regex' => 'Mã lớp không đúng định dạng.',
            ],
            [
                'class_code' => 'lớp hành chính',
                'major_code' => 'ngành',
                'mgv' => 'cố vấn học tập',
            ],
        );

        $input = $request->all();
        $input['class_code'] = Str::upper($input['class_code']);
        $input['major_code'] = Str::upper($input['major_code']);
        $input['mgv'] = Str::upper($input['mgv']);

        FormalClass::create($input);

        return Redirect::route('formal-class.index')->with('success', 'Thêm lớp hành chính thành công.');
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
    public function edit(string $code)
    {
        $formal_class = FormalClass::find($code);
        $teachers = Teacher::all()->sortBy('name');
        $majors = Major::all()->sortBy('major_name');

        return view('admin.formal-class.edit', compact('formal_class', 'majors', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'class_code' => 'required|string|max:15|regex:/^D[0-9]{2}CQ[A-Za-z]{2}[0-9]{2}-B$/|unique:formal_classes,class_code,' . $code . ',class_code',
                'major_code' => 'required',
                'mgv' => 'required',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'class_code.max' => 'Mã lớp không được vượt quá 15 ký tự.',
                'class_code.unique' => 'Mã lớp đã tồn tại trên hệ thống.',
                'class_code.regex' => 'Mã lớp không đúng định dạng.',
            ],
            [
                'class_code' => 'lớp hành chính',
                'major_code' => 'ngành',
                'mgv' => 'cố vấn học tập',
            ],
        );

        $formal_class = FormalClass::find($code);
        $formal_class['class_code'] = Str::upper($request->class_code);
        $formal_class['major_code'] = Str::upper($request->major_code);
        $formal_class['mgv'] = Str::upper($request->mgv);
        $formal_class->save();

        return Redirect::route('formal-class.index')->with('success', 'Cập nhật lớp hành chính thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        FormalClass::destroy($code);

        return Redirect::route('formal-class.index')->with('success', 'Xóa lớp hành chính thành công.');
    }
}