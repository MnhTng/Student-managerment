<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Teacher;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();

        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'mgv' => 'required|string|max:10|unique:teachers,mgv',
                'name' => 'required|string|max:100',
                'birthday' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:100',
                'phone' => 'required||max:15|regex:/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/|unique:teachers,phone',
                'email' => 'required|string|email|max:100|unique:teachers,email',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'mgv.max' => 'Mã giảng viên tối đa 10 ký tự',
                'mgv.unique' => 'Mã giảng viên đã tồn tại',
                'name.max' => 'Tên giảng viên tối đa 100 ký tự',
                'birthday.date' => 'Ngày sinh phải đúng định dạng ngày/tháng/năm',
                'address.max' => 'Địa chỉ tối đa 100 ký tự',
                'phone.max' => 'Số điện thoại tối đa 15 ký tự',
                'phone.regex' => 'Số điện thoại phải đúng định dạng 0xxx-xxx-xxx',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'email.email' => 'Email phải đúng định dạng email',
                'email.max' => 'Email tối đa 100 ký tự',
                'email.unique' => 'Email đã tồn tại',
            ],
            [
                'mgv' => 'mã giảng viên',
                'name' => 'tên giảng viên',
                'birthday' => 'ngày sinh',
                'gender' => 'giới tính',
                'address' => 'địa chỉ',
                'phone' => 'số điện thoại',
                'email' => 'email',
            ],
        );

        $input = $request->all();
        $input['mgv'] = Str::upper($input['mgv']);
        $input['name'] = Str::title(Str::of($input['name'])->trim());
        $input['birthday'] = date('Y-m-d', strtotime($input['birthday']));
        $input['gender'] = Str::ucfirst($input['gender']);
        $input['address'] = Str::title(Str::of($input['address'])->trim());
        $input['phone'] = Str::replace('-', '', $input['phone']);
        $input['email'] = Str::lower(Str::of($input['email'])->trim());

        Teacher::create($input);

        return Redirect::route('teacher.index')->with('success', 'Thêm giảng viên thành công!');
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
        $teacher = Teacher::find($code);

        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'mgv' => 'required|string|max:10|unique:teachers,mgv,' . $code . ',mgv',
                'name' => 'required|string|max:100',
                'birthday' => 'required|date',
                'gender' => 'required|string',
                'address' => 'required|string|max:100',
                'phone' => 'required|string|max:15|regex:/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/|unique:teachers,phone,' . $request->phone . ',phone',
                'email' => 'required|string|email|max:100|unique:teachers,email,' . $request->email . ',email',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'mgv.max' => 'Mã giảng viên tối đa 10 ký tự',
                'mgv.unique' => 'Mã giảng viên đã tồn tại',
                'name.max' => 'Tên giảng viên tối đa 100 ký tự',
                'birthday.date' => 'Ngày sinh phải đúng định dạng ngày/tháng/năm',
                'address.max' => 'Địa chỉ tối đa 100 ký tự',
                'phone.regex' => 'Số điện thoại phải đúng định dạng 0xxx-xxx-xxx',
                'phone.max' => 'Số điện thoại tối đa 15 ký tự',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'email.email' => 'Email phải đúng định dạng email',
                'email.max' => 'Email tối đa 100 ký tự',
                'email.unique' => 'Email đã tồn tại',
            ],
            [
                'mgv' => 'mã giảng viên',
                'name' => 'tên giảng viên',
                'birthday' => 'ngày sinh',
                'gender' => 'giới tính',
                'address' => 'địa chỉ',
                'phone' => 'số điện thoại',
                'email' => 'email',
            ],
        );

        $teacher = Teacher::find($code);
        $teacher->mgv = Str::upper($request->mgv);
        $teacher->name = Str::title(Str::of($request->name)->trim());
        $teacher->birthday = date('Y-m-d', strtotime($request->birthday));
        $teacher->gender = Str::ucfirst($request->gender);
        $teacher->address = Str::title(Str::of($request->address)->trim());
        $teacher->phone = Str::replace('-', '', $request->phone);
        $teacher->email = Str::lower(Str::of($request->email)->trim());
        $teacher->save();

        return Redirect::route('teacher.index')->with('success', 'Cập nhật giảng viên thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        Teacher::destroy($code);

        return Redirect::route('teacher.index')->with('success', 'Xóa giảng viên thành công!');
    }
}
