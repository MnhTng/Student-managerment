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
    public function index()
    {
        $school_years = SchoolYear::all();

        return view('admin.school-year.index', compact('school_years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.school-year.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'semester' => 'required',
                'start_year' => 'required|regex:/[0-9]{4}/',
                'end_year' => 'required|regex:/[0-9]{4}/',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'regex' => 'Trường :attribute phải có định dạng 20xx.',
            ],
            [
                'semester' => 'học kỳ',
                'start_year' => 'năm bắt đầu',
                'end_year' => 'năm kết thúc',
            ]
        );

        $input = $request->all();

        if ($input['start_year'] > $input['end_year']) {
            return Redirect::back()->with('error', 'Năm bắt đầu phải nhỏ hơn năm kết thúc.');
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

        return Redirect::route('school-year.index')->with('success', 'Thêm năm học thành công.');
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
    public function edit(string $slug)
    {
        $school_year = SchoolYear::find($slug);

        return view('admin.school-year.edit', compact('school_year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $request->validate(
            [
                'school_year' => 'required|regex:/20[0-9]{2}-20[0-9]{2}/',
                'semester' => 'required',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'regex' => 'Trường :attribute phải có định dạng 20xx-20xx.',
            ],
            [
                'school_year' => 'năm học',
                'semester' => 'học kỳ',
            ]
        );

        $newSlug = $request->school_year . '-' . $request->semester;

        if ($newSlug != $slug && SchoolYear::find($newSlug)) {
            return Redirect::back()->with('error', 'Năm học đã tồn tại.');
        }

        $school_year = SchoolYear::find($slug);
        $school_year->semester = $request->semester;
        $school_year->school_term = $request->school_year;
        $school_year->slug = $request->school_year . '-' . $request->semester;
        $school_year->save();

        return Redirect::route('school-year.index')->with('success', 'Cập nhật năm học thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        SchoolYear::destroy($slug);

        return Redirect::route('school-year.index')->with('success', 'Xóa năm học thành công.');
    }
}
