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
    public function index(string $locale = 'vi')
    {
        $teachers = Teacher::all();

        return view('admin.teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        return view('admin.teacher.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
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
                'required' => __('The :attribute field cannot be empty.'),
                'mgv.max' => __('The :attribute field must not exceed :max characters.'),
                'mgv.unique' => __('The :attribute field already exists on the system.'),
                'name.max' => __('The :attribute field must not exceed :max characters.'),
                'birthday.date' => __('The :attribute field is not in the correct format.'),
                'address.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.regex' => __('The :attribute field is not in the correct format.'),
                'phone.unique' => __('The :attribute field already exists on the system.'),
                'email.email' => __('The :attribute field is not in the correct format.'),
                'email.max' => __('The :attribute field must not exceed :max characters.'),
                'email.unique' => __('The :attribute field already exists on the system.'),
            ],
            [
                'mgv' => __('Teacher Code'),
                'name' => __('Teacher Name'),
                'birthday' => __('Birthday'),
                'gender' => __('Gender'),
                'address' => __('Address'),
                'phone' => __('Phone'),
                'email' => __('Email'),
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

        return Redirect::route('teacher.index')->with('success', __('Teacher added successfully.'));
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
        $teacher = Teacher::find($code);

        return view('admin.teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
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
                'required' => __('The :attribute field cannot be empty.'),
                'mgv.max' => __('The :attribute field must not exceed :max characters.'),
                'mgv.unique' => __('The :attribute field already exists on the system.'),
                'name.max' => __('The :attribute field must not exceed :max characters.'),
                'birthday.date' => __('The :attribute field is not in the correct format.'),
                'address.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.regex' => __('The :attribute field is not in the correct format.'),
                'phone.max' => __('The :attribute field must not exceed :max characters.'),
                'phone.unique' => __('The :attribute field already exists on the system.'),
                'email.email' => __('The :attribute field is not in the correct format.'),
                'email.max' => __('The :attribute field must not exceed :max characters.'),
                'email.unique' => __('The :attribute field already exists on the system.'),
            ],
            [
                'mgv' => __('Teacher Code'),
                'name' => __('Teacher Name'),
                'birthday' => __('Birthday'),
                'gender' => __('Gender'),
                'address' => __('Address'),
                'phone' => __('Phone'),
                'email' => __('Email'),
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

        return Redirect::route('teacher.index')->with('success', __('The teacher has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        Teacher::destroy($code);

        return Redirect::route('teacher.index')->with('success', __('Deleted teacher successfully.'));
    }
}