<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\Major;
use App\Models\Faculty;

class MajorImport
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

                if (count($cells) < 3 || str_contains($cells[0], 'major_code')) {
                    continue;
                }
                if (strlen($cells[0]) > 10 || strlen($cells[1]) > 100) {
                    return back()->with('error', __('Invalid major format!'));
                }

                $data[] = [
                    'major_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'major_name' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[1]))),
                    'faculty_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[2]))),
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
                    $major = Major::find($row['major_code']);
                    $faculty = Faculty::find($row['faculty_code']);

                    if (!$faculty) {
                        return back()->with('error', __('Faculty does not exist!'));
                    }

                    if ($major) {
                        $major->major_code = $row['major_code'];
                        $major->major_name = $row['major_name'];
                        $major->faculty_code = $row['faculty_code'];
                        $major->updated_at = $row['updated_at'];
                        $major->save();
                    } else {
                        Major::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('faculty.index')->with('success', __('Import successful!'));
    }
}
