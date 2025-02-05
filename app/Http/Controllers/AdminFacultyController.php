<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Faculty;

class AdminFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = Faculty::all();

        return view('admin.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faculty.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'faculty_code' => 'required|string|max:10|unique:faculties,faculty_code',
                'faculty_name' => 'required|string|max:100',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'faculty_code.max' => 'Mã khoa không được vượt quá 10 ký tự.',
                'faculty_code.unique' => 'Mã khoa đã tồn tại trên hệ thống.',
                'faculty_name.max' => 'Tên khoa không được vượt quá 100 ký tự.',
            ],
            [
                'faculty_code' => 'mã khoa',
                'faculty_name' => 'tên khoa',
            ],
        );

        $input = $request->all();
        $input['faculty_code'] = Str::upper(Str::of($input['faculty_code'])->trim());
        $input['faculty_name'] = Str::ucfirst(Str::of($input['faculty_name'])->trim());

        Faculty::create($input);

        return Redirect::route('faculty.index')->with("success", 'Thêm khoa thành công!');
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
        $faculty = Faculty::find($code);

        return view('admin.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'faculty_code' => 'required|string|max:10|unique:faculties,faculty_code,' . $code . ',faculty_code',
                'faculty_name' => 'required|string|max:100',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'faculty_code.max' => 'Mã khoa không được vượt quá 10 ký tự.',
                'faculty_name.max' => 'Tên khoa không được vượt quá 100 ký tự.',
            ],
            [
                'faculty_code' => 'mã khoa',
                'faculty_name' => 'tên khoa',
            ],
        );

        //todo Nếu khai báo onUpdate thì bỏ qua
        //! Tắt kiểm tra ràng buộc khóa ngoại
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //! Thực hiện cập nhật bảng phụ rồi tới bảng chính
        // if (Major::where('faculty_code', $code)->exists()) {
        //     Major::where('faculty_code', $code)->update(['faculty_code' => Str::upper($request->faculty_code)]);
        // }

        // if (Student::where('faculty_code', $code)->exists()) {
        //     Student::where('faculty_code', $code)->update(['faculty_code' => Str::upper($request->faculty_code)]);
        // }

        //! Bật kiểm tra ràng buộc khóa ngoại
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faculty = Faculty::find($code);
        $faculty->faculty_code = Str::upper(Str::of($request->faculty_code)->trim());
        $faculty->faculty_name = Str::ucfirst(Str::of($request->faculty_name)->trim());
        $faculty->save();

        return Redirect::route('faculty.index')->with("success", 'Cập nhật khoa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        Faculty::destroy($code);

        return Redirect::route('faculty.index')->with("success", 'Xóa khoa thành công!');
    }
}
