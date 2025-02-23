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
    public function index(string $locale = 'vi')
    {
        // Redirect to route 'faculty.index'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $locale = 'vi')
    {
        $faculty_code = $request->route('faculty_code');

        return view('admin.major.add', compact('faculty_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'major_code' => 'required|string|max:10|unique:majors,major_code',
                'major_name' => 'required|string|max:100',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'major_code.max' => __('The :attribute field must not exceed :max characters.'),
                'major_code.unique' => __('The :attribute field already exists on the system.'),
                'major_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'major_code' => __('Major Code'),
                'major_name' => __('Major Name'),
            ],
        );

        $input = $request->all();
        $input['major_code'] = Str::upper(Str::of($input['major_code'])->trim());
        $input['major_name'] = Str::ucfirst(Str::of($input['major_name'])->trim());

        Major::create($input);

        return Redirect::route('faculty.index')->with("success", __('Major added successfully.'));
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
        $major = Major::find($code);

        return view('admin.major.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'major_code' => 'required|string|max:10|unique:majors,major_code,' . $code . ',major_code',
                'major_name' => 'required|string|max:100',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'major_code.max' => __('The :attribute field must not exceed :max characters.'),
                'major_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'major_code' => __('Major Code'),
                'major_name' => __('Major Name'),
            ],
        );

        $major = Major::find($code);
        $major['major_code'] = Str::upper(Str::of($request->major_code)->trim());
        $major['major_name'] = Str::ucfirst(Str::of($request->major_name)->trim());
        $major->save();

        return Redirect::route('faculty.index')->with("success", __('The major has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        Major::destroy($code);

        return Redirect::route('faculty.index')->with("success", __('Deleted major successfully.'));
    }
}
