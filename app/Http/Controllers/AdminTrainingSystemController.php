<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\TrainingSystem;

class AdminTrainingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $locale = 'vi')
    {
        $training_systems = TrainingSystem::all();

        return view('admin.training-system.index', compact('training_systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $locale = 'vi')
    {
        return view('admin.training-system.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $locale = 'vi')
    {
        $request->validate(
            [
                'training_code' => 'required|string|max:10|unique:training_systems,training_code',
                'training_name' => 'required|string|max:50',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'training_code.max' => __('The :attribute field must not exceed :max characters.'),
                'training_code.unique' => __('The :attribute field already exists on the system.'),
                'training_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'training_code' => __('Training System Code'),
                'training_name' => __('Training System Name'),
            ],
        );

        $input = $request->all();
        $input['training_code'] = Str::upper(Str::of($input['training_code'])->trim());
        $input['training_name'] = Str::ucfirst(Str::of($input['training_name'])->trim());

        TrainingSystem::create($input);

        return Redirect::route('training-system.index')->with("success", __('Training system added successfully.'));
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
        $training_system = TrainingSystem::find($code);

        return view('admin.training-system.edit', compact('training_system'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $locale = 'vi', string $code)
    {
        $request->validate(
            [
                'training_code' => 'required|string|max:10|unique:training_systems,training_code,' . $code . ',training_code',
                'training_name' => 'required|string|max:50',
            ],
            [
                'required' => __('The :attribute field cannot be empty.'),
                'training_code.max' => __('The :attribute field must not exceed :max characters.'),
                'training_name.max' => __('The :attribute field must not exceed :max characters.'),
            ],
            [
                'training_code' => __('Training System Code'),
                'training_name' => __('Training System Name'),
            ],
        );

        $faculty = TrainingSystem::find($code);
        $faculty->training_code = Str::upper(Str::of($request->training_code)->trim());
        $faculty->training_name = Str::ucfirst(Str::of($request->training_name)->trim());
        $faculty->save();

        return Redirect::route('training-system.index')->with("success", __('The training system has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $locale = 'vi', string $code)
    {
        TrainingSystem::destroy($code);

        return Redirect::route('training-system.index')->with("success", __('Deleted training system successfully.'));
    }
}
