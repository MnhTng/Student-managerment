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
    public function index(string $locale = 'vi')
    {
        $subjects = Subject::all();

        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        return view('admin.subject.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'subject_code' => 'required|string|regex:/[A-Za-z]{3,4}[0-9]{3,6}/|unique:subjects,subject_code',
                'subject_name' => 'required|string',
                'credit' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'subject_code.regex' => __('The :attribute field is not in the correct format.'),
                'subject_code.unique' => __('The :attribute field already exists on the system.'),
            ],
            [
                'subject_code' => __('Subject Code'),
                'subject_name' => __('Subject Name'),
                'credit' => __('Credit'),
            ]
        );

        $input = $request->all();
        $input['subject_code'] = Str::upper($input['subject_code']);
        $input['subject_name'] = Str::ucfirst(Str::of($input['subject_name'])->trim());

        Subject::create($input);

        return Redirect::route('subject.index')->with("success", __('Subject added successfully.'));
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
        $subject = Subject::find($code);

        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'subject_code' => 'required|string|regex:/[A-Za-z]{3,4}[0-9]{3,6}/|unique:subjects,subject_code,' . $code . ',subject_code',
                'subject_name' => 'required|string',
                'credit' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'subject_code.regex' => __('The :attribute field is not in the correct format.'),
                'subject_code.unique' => __('The :attribute field already exists on the system.'),
            ],
            [
                'subject_code' => __('Subject Code'),
                'subject_name' => __('Subject Name'),
                'credit' => __('Credit'),
            ]
        );

        $subject = Subject::find($code);
        $subject->subject_code = Str::upper($request->subject_code);
        $subject->subject_name = Str::ucfirst(Str::of($request->subject_name)->trim());
        $subject->credit = $request->credit;
        $subject->save();

        return Redirect::route('subject.index')->with("success", __('The subject has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        Subject::destroy($code);

        return Redirect::route('subject.index')->with("success", __('Deleted subject successfully.'));
    }
}
