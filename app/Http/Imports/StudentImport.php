<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\Student;
use App\Models\FormalClass;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\TrainingSystem;


class StudentImport
{
    public function model(Request $request, string $locale = 'vi')
    {
        $filePath = $request->file('file')->getRealPath();

        $ext = $request->file('file')->getClientOriginalExtension();
        if ($ext == 'xlsx' || $ext == 'xls') {
            $reader = ReaderEntityFactory::createXLSXReader();
        } else if ($ext == 'csv') {
            $reader = ReaderEntityFactory::createCSVReader();
        } else {
            $reader = ReaderEntityFactory::createODSReader();
        }
        $reader->open($filePath);

        $data = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $cells = $row->toArray();

                if (str_contains($cells[0], ';'))
                    $cells = explode(';', $cells[0]);

                if (count($cells) < 13 || str_contains($cells[0], 'msv')) {
                    continue;
                }
                if (!preg_match('/^B[0-9]{2}DC[A-Za-z]{2}[0-9]{3}$/', $cells[0]) || Str::length($cells[0]) > 10 || Str::length($cells[1]) > 100) {
                    return back()->with('error', __('Invalid student format!'));
                } else if ((Str::contains($cells[5], '-') && !preg_match('/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/', $cells[5])) || !preg_match('/^0[1-9]{1}[0-9]{8}$/', $cells[5]) || Str::length($cells[5]) > 15) {
                    return back()->with('error', __('Invalid phone number format!'));
                } else if (!filter_var($cells[6], FILTER_VALIDATE_EMAIL)) {
                    return back()->with('error', __('Invalid email format!'));
                } else if (!preg_match('/^[0-9]{12}$/', $cells[7]) || Str::length($cells[7]) > 12) {
                    return back()->with('error', __('Invalid ID Card format!'));
                } else if (!preg_match('/^[0-9]{4}-[0-9]{4}$/', $cells[13])) {
                    return back()->with('error', __('Invalid academic year format!'));
                }

                $data[] = [
                    'msv' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'name' => Str::title(Str::trim(Str::replace('"', '', $cells[1]))),
                    'birthday' => is_string($cells[2]) ? Str::replace('"', '', $cells[2]) : Carbon::parse($cells[2])->format('Y-m-d'),
                    'gender' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[3]))),
                    'address' => Str::title(Str::trim(Str::replace('"', '', $cells[4]))),
                    'phone' => Str::trim(Str::replace('"', '', Str::replace('-', '', $cells[5]))),
                    'email' => Str::lower(Str::trim(Str::replace('"', '', $cells[6]))),
                    'cccd' => Str::upper(Str::trim(Str::replace('"', '', $cells[7]))),
                    'ethnicity' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[8]))),
                    'class_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[9]))),
                    'faculty_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[10]))),
                    'major_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[11]))),
                    'training_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[12]))),
                    'academic_year' => Str::trim(Str::replace('"', '', $cells[13])),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        $reader->close();

        if ($data !== []) {
            DB::beginTransaction();

            try {
                foreach ($data as $row) {
                    $student = Student::find($row['msv']);
                    $formalClass = FormalClass::find($student->class_code);
                    $faculty = Faculty::find($student->faculty_code);
                    $major = Major::find($student->major_code);
                    $trainingSystem = TrainingSystem::find($student->training_code);

                    if (!$formalClass) {
                        return back()->with('error', __('Formal class does not exist!'));
                    }
                    if (!$faculty) {
                        return back()->with('error', __('Faculty does not exist!'));
                    }
                    if (!$major) {
                        return back()->with('error', __('Major does not exist!'));
                    }
                    if (!$trainingSystem) {
                        return back()->with('error', __('Training system does not exist!'));
                    }

                    if ($student) {
                        $student->name = $row['name'];
                        $student->birthday = $row['birthday'];
                        $student->gender = $row['gender'];
                        $student->address = $row['address'];
                        $student->phone = $row['phone'];
                        $student->email = $row['email'];
                        $student->cccd = $row['cccd'];
                        $student->ethnicity = $row['ethnicity'];
                        $student->class_code = $row['class_code'];
                        $student->faculty_code = $row['faculty_code'];
                        $student->major_code = $row['major_code'];
                        $student->training_code = $row['training_code'];
                        $student->academic_year = $row['academic_year'];
                        $student->updated_at = $row['updated_at'];
                        $student->save();
                    } else {
                        Student::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('student.index')->with('success', __('Import successful!'));
    }
}
