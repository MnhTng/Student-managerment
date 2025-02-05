<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Subject;

class AdminSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();

        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'subject_code' => 'required|string|regex:/[A-Za-z]{3,4}[0-9]{3,6}/|unique:subjects,subject_code',
                'subject_name' => 'required|string',
                'credit' => 'required',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'subject_code.regex' => 'Mã môn học không đúng định dạng.',
                'subject_code.unique' => 'Môn học đã tồn tại trên hệ thống.',
            ],
            [
                'subject_code' => 'mã môn học',
                'subject_name' => 'tên môn học',
                'credit' => 'số tín chỉ',
            ]
        );

        $input = $request->all();
        $input['subject_code'] = Str::upper($input['subject_code']);
        $input['subject_name'] = Str::ucfirst(Str::of($input['subject_name'])->trim());

        Subject::create($input);

        return Redirect::route('subject.index')->with("success", 'Thêm môn học thành công!');
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
        $subject = Subject::find($code);

        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'subject_code' => 'required|string|regex:/[A-Za-z]{3,4}[0-9]{3,6}/|unique:subjects,subject_code,' . $code . ',subject_code',
                'subject_name' => 'required|string',
                'credit' => 'required',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'subject_code.regex' => 'Mã môn học không đúng định dạng.',
                'subject_code.unique' => 'Môn học đã tồn tại trên hệ thống.',
            ],
            [
                'subject_code' => 'mã môn học',
                'subject_name' => 'tên môn học',
                'credit' => 'số tín chỉ',
            ]
        );

        $subject = Subject::find($code);
        $subject->subject_code = Str::upper($request->subject_code);
        $subject->subject_name = Str::ucfirst(Str::of($request->subject_name)->trim());
        $subject->credit = $request->credit;
        $subject->save();

        return Redirect::route('subject.index')->with("success", 'Cập nhật môn học thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        Subject::destroy($code);

        return Redirect::route('subject.index')->with("success", 'Xóa môn học thành công!');
    }
}
