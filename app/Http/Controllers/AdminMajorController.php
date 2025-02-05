<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Major;

class AdminMajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect to route 'faculty.index'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $faculty_code = $request->route('faculty_code');

        return view('admin.major.add', compact('faculty_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'major_code' => 'required|string|max:10|unique:majors,major_code',
                'major_name' => 'required|string|max:100',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'major_code.max' => 'Mã ngành không được vượt quá 10 ký tự.',
                'major_code.unique' => 'Mã ngành đã tồn tại trên hệ thống.',
                'major_name.max' => 'Tên ngành không được vượt quá 100 ký tự.',
            ],
            [
                'major_code' => 'mã ngành',
                'major_name' => 'tên ngành',
            ],
        );

        $input = $request->all();
        $input['major_code'] = Str::upper(Str::of($input['major_code'])->trim());
        $input['major_name'] = Str::ucfirst(Str::of($input['major_name'])->trim());

        Major::create($input);

        return Redirect::route('faculty.index')->with("success", 'Thêm ngành thành công!');
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
        $major = Major::find($code);

        return view('admin.major.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'major_code' => 'required|string|max:10|unique:majors,major_code,' . $code . ',major_code',
                'major_name' => 'required|string|max:100',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'major_code.max' => 'Mã ngành không được vượt quá 10 ký tự.',
                'major_name.max' => 'Tên ngành không được vượt quá 100 ký tự.',
            ],
            [
                'major_code' => 'mã ngành',
                'major_name' => 'tên ngành',
            ],
        );

        $major = Major::find($code);
        $major['major_code'] = Str::upper(Str::of($request->major_code)->trim());
        $major['major_name'] = Str::ucfirst(Str::of($request->major_name)->trim());
        $major->save();

        return Redirect::route('faculty.index')->with("success", 'Cập nhật ngành thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        Major::destroy($code);

        return Redirect::route('faculty.index')->with("success", 'Xóa ngành thành công!');
    }
}
