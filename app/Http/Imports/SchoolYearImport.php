<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\SchoolYear;

class SchoolYearImport
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

                if (count($cells) < 3 || str_contains($cells[2], 'slug')) {
                    continue;
                }
                if (!preg_match('/20[0-9]{2}-20[0-9]{2}/', $cells[2])) {
                    return back()->with('error', __('Invalid school year format!'));
                }

                $data[] = [
                    'semester' => (int) Str::trim(Str::replace('"', '', $cells[0])),
                    'school_term' => Str::trim(Str::replace('"', '', $cells[1])),
                    'slug' => Str::trim(Str::replace('"', '', $cells[2])),
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
                    $school_year = SchoolYear::find($row['slug']);

                    if ($school_year) {
                        $school_year->semester = $row['semester'];
                        $school_year->school_term = $row['school_term'];
                        $school_year->updated_at = $row['updated_at'];
                        $school_year->save();
                    } else {
                        SchoolYear::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('school-year.index')->with('success', __('Import successful!'));
    }
}
