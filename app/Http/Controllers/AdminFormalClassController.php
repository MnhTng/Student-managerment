<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
    public function index(string $locale = 'vi')
    {
        $formal_classes = FormalClass::all();

        return view('admin.formal-class.index', compact('formal_classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        $teachers = Teacher::all()->sortBy('name');
        $majors = Major::all()->sortBy('major_name');

        return view('admin.formal-class.add', compact('teachers', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'class_code' => 'required|string|max:15|regex:/^D[0-9]{2}[A-Za-z]{4}[0-9]{2}-B$/|unique:formal_classes,class_code',
                'major_code' => 'required',
                'mgv' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'class_code.max' => __('The :attribute field must not exceed :max characters.'),
                'class_code.unique' => __('The :attribute field already exists on the system.'),
                'class_code.regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'class_code' => __('Formal Class'),
                'major_code' => __('Major'),
                'mgv' => __('Teacher'),
            ],
        );

        $input = $request->all();
        $input['class_code'] = Str::upper($input['class_code']);
        $input['major_code'] = Str::upper($input['major_code']);
        $input['mgv'] = Str::upper($input['mgv']);
        $input['created_at'] = Carbon::now();
        $input['updated_at'] = Carbon::now();

        FormalClass::create($input);

        return Redirect::route('formal-class.index')->with('success', __('Formal class added successfully.'));
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
        $formal_class = FormalClass::find($code);
        $teachers = Teacher::all()->sortBy('name');
        $majors = Major::all()->sortBy('major_name');

        return view('admin.formal-class.edit', compact('formal_class', 'majors', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'class_code' => 'required|string|max:15|regex:/^D[0-9]{2}[A-Za-z]{4}[0-9]{2}-B$/|unique:formal_classes,class_code,' . $code . ',class_code',
                'major_code' => 'required',
                'mgv' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'class_code.max' => __('The :attribute field must not exceed :max characters.'),
                'class_code.unique' => __('The :attribute field already exists on the system.'),
                'class_code.regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'class_code' => __('Formal Class'),
                'major_code' => __('Major'),
                'mgv' => __('Teacher'),
            ],
        );

        $formal_class = FormalClass::find($code);
        $formal_class['class_code'] = Str::upper($request->class_code);
        $formal_class['major_code'] = Str::upper($request->major_code);
        $formal_class['mgv'] = Str::upper($request->mgv);
        $formal_class['updated_at'] = Carbon::now();
        $formal_class->save();

        return Redirect::route('formal-class.index')->with('success', __('The formal class has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        FormalClass::destroy($code);

        return Redirect::route('formal-class.index')->with('success', __('Deleted formal class successfully.'));
    }
}