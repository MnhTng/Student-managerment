<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\CreditClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SchoolYear;

class CreditClassImport
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

                if (count($cells) < 7 || str_contains($cells[1], 'room')) {
                    continue;
                }
                if (strlen($cells[1]) < 5) {
                    return back()->with('error', __('Invalid room format!'));
                }

                $data[] = [
                    'room' => Str::upper(Str::trim(Str::replace('"', '', $cells[1]))),
                    'start_time' => is_string($cells[2]) ? Str::replace('"', '', $cells[2]) : Carbon::parse($cells[2])->format('Y-m-d H:i:s'),
                    'end_time' => is_string($cells[3]) ? Str::replace('"', '', $cells[3]) : Carbon::parse($cells[3])->format('Y-m-d H:i:s'),
                    'mgv' => Str::upper(Str::trim(Str::replace('"', '', $cells[4]))),
                    'msv' => Str::upper(Str::trim(Str::replace('"', '', $cells[5]))),
                    'subject_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[6]))),
                    'school_year' => Str::trim(Str::replace('"', '', $cells[7])),
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
                    $credit_class = CreditClass::where('room', $row['room'])
                        ->where('start_time', $row['start_time'])
                        ->where('end_time', $row['end_time'])
                        ->where('mgv', $row['mgv'])
                        ->where('msv', $row['msv'])
                        ->where('subject_code', $row['subject_code'])
                        ->where('school_year', $row['school_year'])
                        ->first();
                    $teacher = Teacher::where('mgv', $row['mgv'])->first();
                    $student = Student::where('msv', $row['msv'])->first();
                    $subject = Subject::where('subject_code', $row['subject_code'])->first();
                    $school_year = SchoolYear::where('slug', $row['school_year'])->first();

                    if (!$teacher) {
                        return back()->with('error', __('Teacher does not exist!'));
                    }
                    if (!$student) {
                        return back()->with('error', __('Student does not exist!'));
                    }
                    if (!$subject) {
                        return back()->with('error', __('Subject does not exist!'));
                    }
                    if (!$school_year) {
                        return back()->with('error', __('School year does not exist!'));
                    }

                    if ($credit_class) {
                        $credit_class->room = $row['room'];
                        $credit_class->start_time = $row['start_time'];
                        $credit_class->end_time = $row['end_time'];
                        $credit_class->mgv = $row['mgv'];
                        $credit_class->msv = $row['msv'];
                        $credit_class->subject_code = $row['subject_code'];
                        $credit_class->school_year = $row['school_year'];
                        $credit_class->updated_at = $row['updated_at'];
                        $credit_class->save();
                    } else {
                        CreditClass::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('credit-class.index')->with('success', __('Import successful!'));
    }
}
