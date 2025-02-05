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
    public function index()
    {
        $training_systems = TrainingSystem::all();

        return view('admin.training-system.index', compact('training_systems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.training-system.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'training_code' => 'required|string|max:10|unique:training_systems,training_code',
                'training_name' => 'required|string|max:50',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'training_code.max' => 'Mã đào tạo không được vượt quá 10 ký tự.',
                'training_code.unique' => 'Mã đào tạo đã tồn tại trên hệ thống.',
                'training_name.max' => 'Tên hệ đào tạo không được vượt quá 50 ký tự.',
            ],
            [
                'training_code' => 'mã đào tạo',
                'training_name' => 'tên hệ đào tạo',
            ],
        );

        $input = $request->all();
        $input['training_code'] = Str::upper(Str::of($input['training_code'])->trim());
        $input['training_name'] = Str::ucfirst(Str::of($input['training_name'])->trim());

        TrainingSystem::create($input);

        return Redirect::route('training-system.index')->with("success", 'Thêm hệ đào tạo thành công!');
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
        $training_system = TrainingSystem::find($code);

        return view('admin.training-system.edit', compact('training_system'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        $request->validate(
            [
                'training_code' => 'required|string|max:10|unique:training_systems,training_code,' . $code . ',training_code',
                'training_name' => 'required|string|max:50',
            ],
            [
                'required' => 'Trường :attribute không được để trống.',
                'training_code.max' => 'Mã đào tạo không được vượt quá 10 ký tự.',
                'training_name.max' => 'Tên hệ đào tạo không được vượt quá 50 ký tự.',
            ],
            [
                'training_code' => 'mã đào tạo',
                'training_name' => 'tên hệ đào tạo',
            ],
        );

        $faculty = TrainingSystem::find($code);
        $faculty->training_code = Str::upper(Str::of($request->training_code)->trim());
        $faculty->training_name = Str::ucfirst(Str::of($request->training_name)->trim());
        $faculty->save();

        return Redirect::route('training-system.index')->with("success", 'Cập nhật hệ đào tạo thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        TrainingSystem::destroy($code);

        return Redirect::route('training-system.index')->with("success", 'Xóa hệ đào tạo thành công!');
    }
}
