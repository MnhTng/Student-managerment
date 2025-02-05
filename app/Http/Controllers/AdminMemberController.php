<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = User::all();

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = User::all();
        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.member.add', compact('members', 'teachers', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
                'role' => 'required|string|in:admin,teacher,student',
                'identifier' => 'required|string'
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'string' => 'Trường :attribute phải là chuỗi ký tự.',
                'email' => 'Trường :attribute phải là địa chỉ email.',
                'max' => 'Trường :attribute không được quá :max ký tự.',
                'min' => 'Trường :attribute không được ít hơn :min ký tự.',
                'unique' => 'Trường :attribute đã tồn tại.',
                'in' => 'Trường :attribute không hợp lệ.'
            ],
            [
                'name' => 'tên',
                'email' => 'email',
                'password' => 'mật khẩu',
                'role' => 'vai trò',
                'identifier' => 'định danh'
            ]
        );

        $member = $request->all();
        $member['name'] = Str::title(Str::of($member['name'])->trim());
        $member['email'] = Str::lower(Str::of($member['email'])->trim());
        $member['password'] = Hash::make($member['password']);
        $member['identifier'] = $member['identifier'] != 'admin' ? Str::upper(Str::of($member['identifier'])->trim()) : $member['identifier'];

        if ($member['identifier'] != 'admin' && !Teacher::find($member['identifier']) && !Student::find($member['identifier']))
            return Redirect::back()->with('error', 'Định danh không tồn tại.');

        User::create($member);

        return Redirect::route('member.index')->with('success', 'Thêm thành viên mới thành công.');
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
    public function edit(string $id)
    {
        $member = User::find($id);
        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.member.edit', compact('member', 'teachers', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $request->email . ',email',
                'password' => 'nullable|string|min:6',
                'role' => 'required|string|in:admin,teacher,student',
                'identifier' => 'required|string'
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'string' => 'Trường :attribute phải là chuỗi ký tự.',
                'email' => 'Trường :attribute phải là địa chỉ email.',
                'max' => 'Trường :attribute không được quá :max ký tự.',
                'min' => 'Trường :attribute không được ít hơn :min ký tự.',
                'unique' => 'Trường :attribute đã tồn tại.',
                'in' => 'Trường :attribute không hợp lệ.'
            ],
            [
                'name' => 'tên',
                'email' => 'email',
                'password' => 'mật khẩu',
                'role' => 'vai trò',
                'identifier' => 'định danh'
            ]
        );

        if ($request->identifier != 'admin' && !Teacher::find($request->identifier) && !Student::find($request->identifier))
            return Redirect::back()->with('error', 'Định danh không tồn tại.');

        $member = User::find($id);

        $member->name = Str::title(Str::of($request->name)->trim());
        $member->email = Str::lower(Str::of($request->email)->trim());
        $member->role = $request->role;
        $member->identifier = $member->identifier != 'admin' ? Str::upper(Str::of($request->identifier)->trim()) : $member->identifier;
        if (!empty($request->password))
            $member->password = Hash::make($request->password);
        $member->save();

        return Redirect::route('member.index')->with('success', 'Cập nhật thành viên thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return Redirect::route('member.index')->with('success', 'Xóa thành viên thành công.');
    }

    public function identify($role)
    {
        if ($role === 'admin')
            return 'admin';
        else if ($role === 'teacher') {
            $teachers = Teacher::all();

            $response = [];
            foreach ($teachers as $teacher) {
                $response[] = [
                    'name' => $teacher->name,
                    'identifier' => $teacher->mgv,
                    'email' => $teacher->email
                ];
            }

            return response()->json($response);
        } else {
            $students = Student::all();

            $response = [];
            foreach ($students as $student) {
                $response[] = [
                    'name' => $student->name,
                    'identifier' => $student->msv,
                    'email' => $student->email
                ];
            }

            return response()->json($response);
        }
    }

    public function info($identifier)
    {
        $role = Str::of($identifier)->explode('-')->last();
        $identify = Str::of($identifier)->explode('-')->first();

        if ($role === 'teacher') {
            $teacher = Teacher::find($identify);

            if ($teacher)
                return response()->json([
                    'name' => $teacher->name,
                    'email' => $teacher->email
                ]);
        } else if ($role === 'student') {
            $student = Student::find($identify);

            if ($student)
                return response()->json([
                    'name' => $student->name,
                    'email' => $student->email
                ]);
        }
    }
}
