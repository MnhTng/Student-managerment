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
    public function index(string $locale = 'vi')
    {
        $faculties = Faculty::all();

        return view('admin.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        return view('admin.faculty.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'faculty_code' => 'required|string|max:10|unique:faculties,faculty_code',
                'faculty_name' => 'required|string|max:100',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'faculty_code.max' => __('The :attribute field must not exceed :max characters.'),
                'faculty_code.unique' => __('The :attribute field already exists on the system.'),
                'faculty_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'faculty_code' => __('Faculty Code'),
                'faculty_name' => __('Faculty Name'),
            ],
        );

        $input = $request->all();
        $input['faculty_code'] = Str::upper(Str::of($input['faculty_code'])->trim());
        $input['faculty_name'] = Str::ucfirst(Str::of($input['faculty_name'])->trim());

        Faculty::create($input);

        return Redirect::route('faculty.index')->with("success", __('Faculty added successfully.'));
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
        $faculty = Faculty::find($code);

        return view('admin.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'faculty_code' => 'required|string|max:10|unique:faculties,faculty_code,' . $code . ',faculty_code',
                'faculty_name' => 'required|string|max:100',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'faculty_code.max' => __('The :attribute field must not exceed :max characters.'),
                'faculty_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'faculty_code' => __('Faculty'),
                'faculty_name' => __('Faculty Name'),
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

        return Redirect::route('faculty.index')->with("success", __('The faculty has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        Faculty::destroy($code);

        return Redirect::route('faculty.index')->with("success", __('Deleted faculty successfully.'));
    }
}