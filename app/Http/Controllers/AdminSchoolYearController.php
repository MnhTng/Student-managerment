<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\SchoolYear;
use App\Models\CreditClass;
use App\Models\Score;

class AdminSchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $locale = 'vi')
    {
        $school_years = SchoolYear::all();

        return view('admin.school-year.index', compact('school_years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        return view('admin.school-year.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'semester' => 'required',
                'start_year' => 'required|regex:/[0-9]{4}/',
                'end_year' => 'required|regex:/[0-9]{4}/',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'semester' => __('Semester'),
                'start_year' => __('Start Year'),
                'end_year' => __('End Year'),
            ]
        );

        $input = $request->all();

        if ($input['start_year'] > $input['end_year']) {
            return Redirect::back()->with('error', __('The start year must be smaller than the end year.'));
        }

        for ($i = $input['start_year']; $i <= $input['end_year']; $i++) {
            foreach ($input['semester'] as $semester) {
                $slug = $i . '-' . $i + 1 . '-' . $semester;

                if (!SchoolYear::find($slug)) {
                    SchoolYear::create([
                        'semester' => $semester,
                        'school_term' => $i . '-' . $i + 1,
                        'slug' => $slug,
                    ]);
                }
            }
        }

        return Redirect::route('school-year.index')->with('success', __('School year added successfully.'));
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
    public function edit(string $locale = 'vi', string $slug)
    {
        $school_year = SchoolYear::find($slug);

        return view('admin.school-year.edit', compact('school_year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $slug)
    {
        $request->validate(
            [
                'school_year' => 'required|regex:/20[0-9]{2}-20[0-9]{2}/',
                'semester' => 'required',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'regex' => __('The :attribute field is not in the correct format.'),
            ],
            [
                'school_year' => __('School Year'),
                'semester' => __('Semester'),
            ]
        );

        $newSlug = $request->school_year . '-' . $request->semester;

        if ($newSlug != $slug && SchoolYear::find($newSlug)) {
            return Redirect::back()->with('error', __('School year already exists!'));
        }

        $school_year = SchoolYear::find($slug);
        $school_year->semester = $request->semester;
        $school_year->school_term = $request->school_year;
        $school_year->slug = $request->school_year . '-' . $request->semester;
        $school_year->save();

        return Redirect::route('school-year.index')->with('success', __('The school year has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $slug)
    {
        SchoolYear::destroy($slug);

        return Redirect::route('school-year.index')->with('success', __('Deleted school year successfully.'));
    }
}