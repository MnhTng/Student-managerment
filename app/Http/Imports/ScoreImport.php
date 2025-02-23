<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SchoolYear;


class ScoreImport
{
    public function model(Request $request, string $locale = 'vi', string $credit_class_id)
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

                if (count($cells) < 5 || str_contains($cells[0], 'id')) {
                    continue;
                }
                if ((float) (Str::trim(Str::replace('"', '', $cells[4]))) < 0 || (float) (Str::trim(Str::replace('"', '', $cells[4]))) > 10) {
                    return back()->with('error', __('Invalid score format!'));
                }

                $data[] = [
                    'msv' => Str::upper(Str::trim(Str::replace('"', '', $cells[1]))),
                    'subject_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[2]))),
                    'school_year' => Str::trim(Str::replace('"', '', $cells[3])),
                    'score' => (float) Str::trim(Str::replace('"', '', $cells[4])),
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
                    $score = Score::where('msv', $row['msv'])
                        ->where('subject_code', $row['subject_code'])
                        ->where('school_year', $row['school_year'])
                        ->first();
                    $student = Student::find($row['msv']);
                    $subject = Subject::find($row['subject_code']);
                    $school_year = SchoolYear::find($row['school_year']);

                    if (!$student) {
                        return back()->with('error', __('Student does not exist!'));
                    }
                    if (!$subject) {
                        return back()->with('error', __('Subject does not exist!'));
                    }
                    if (!$school_year) {
                        return back()->with('error', __('School year does not exist!'));
                    }

                    if ($score) {
                        $score->score = $row['score'];
                        $score->updated_at = $row['updated_at'];
                        $score->save();
                    } else {
                        Score::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('score.show', $credit_class_id)->with('success', __('Import successful!'));
    }
}
