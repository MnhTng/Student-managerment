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
    public function index(string $locale = 'vi')
    {
        $members = User::all();

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        $members = User::all();
        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.member.add', compact('members', 'teachers', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
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
                'required' => __('The :attribute field cannot be empty.'),
                'string' => __('The :attribute field must be a string.'),
                'email' => __('The :attribute field is not in the correct format.'),
                'max' => __('The :attribute field must not exceed :max characters.'),
                'min' => __('The :attribute field must have at least :min characters.'),
                'unique' => __('The :attribute field already exists on the system.'),
                'in' => __('The :attribute field is not in the correct format.')
            ],
            [
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'role' => __('Role'),
                'identifier' => __('Identify')
            ]
        );

        $member = $request->all();
        $member['name'] = Str::title(Str::of($member['name'])->trim());
        $member['email'] = Str::lower(Str::of($member['email'])->trim());
        $member['password'] = Hash::make($member['password']);
        $member['identifier'] = $member['identifier'] != 'admin' ? Str::upper(Str::of($member['identifier'])->trim()) : $member['identifier'];

        if ($member['identifier'] != 'admin' && !Teacher::find($member['identifier']) && !Student::find($member['identifier']))
            return Redirect::back()->with('error', __('Identify does not exist!'));

        User::create($member);

        return Redirect::route('member.index')->with('success', __('Member added successfully.'));
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
    public function edit(string $locale = 'vi', string $id)
    {
        $member = User::find($id);
        $teachers = Teacher::all();
        $students = Student::all();

        return view('admin.member.edit', compact('member', 'teachers', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $id)
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
                'required' => __('The :attribute field cannot be empty.'),
                'string' => __('The :attribute field must be a string.'),
                'email' => __('The :attribute field is not in the correct format.'),
                'max' => __('The :attribute field must not exceed :max characters.'),
                'min' => __('The :attribute field must have at least :min characters.'),
                'unique' => __('The :attribute field already exists on the system.'),
                'in' => __('The :attribute field is not in the correct format.')
            ],
            [
                'name' => __('Name'),
                'email' => __('Email'),
                'password' => __('Password'),
                'role' => __('Role'),
                'identifier' => __('Identify')
            ]
        );

        if ($request->identifier != 'admin' && !Teacher::find($request->identifier) && !Student::find($request->identifier))
            return Redirect::back()->with('error', __('Identify does not exist!'));

        $member = User::find($id);

        $member->name = Str::title(Str::of($request->name)->trim());
        $member->email = Str::lower(Str::of($request->email)->trim());
        $member->role = $request->role;
        $member->identifier = $member->identifier != 'admin' ? Str::upper(Str::of($request->identifier)->trim()) : $member->identifier;
        if (!empty($request->password))
            $member->password = Hash::make($request->password);
        $member->save();

        return Redirect::route('member.index')->with('success', __('The member has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $id)
    {
        User::destroy($id);

        return Redirect::route('member.index')->with('success', __('Deleted member successfully.'));
    }

    public function identify(string $locale = 'vi', $role)
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

    public function info(string $locale = 'vi', $identifier)
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
