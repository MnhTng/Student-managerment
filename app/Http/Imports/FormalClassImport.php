<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Carbon\Carbon;

use App\Models\FormalClass;
use App\Models\Teacher;
use App\Models\Major;

class FormalClassImport
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

                // if ($rowIndex < 2) {
                //     continue;
                // }

                if (str_contains($cells[0], ';'))
                    $cells = explode(';', $cells[0]);

                if (count($cells) < 3 || str_contains($cells[0], 'class_code')) {
                    continue;
                }
                if (!preg_match('/^D[0-9]{2}[A-Za-z]{4}[0-9]{2}-B$/', $cells[0]) || strlen($cells[0]) > 15) {
                    return back()->with('error', __('Invalid class code format!'));
                }

                $data[] = [
                    'class_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'mgv' => Str::upper(Str::trim(Str::replace('"', '', $cells[1]))),
                    'major_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[2]))),
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
                    $formal_class = FormalClass::find($row['class_code']);
                    $teacher = Teacher::where('mgv', $row['mgv'])->first();
                    $major = Major::where('major_code', $row['major_code'])->first();

                    if (!$teacher) {
                        return back()->with('error', __('Teacher does not exist!'));
                    }
                    if (!$major) {
                        return back()->with('error', __('Major does not exist!'));
                    }

                    if ($formal_class) {
                        $formal_class->mgv = $row['mgv'];
                        $formal_class->major_code = $row['major_code'];
                        $formal_class->updated_at = $row['updated_at'];
                        $formal_class->save();
                    } else {
                        FormalClass::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('formal-class.index')->with('success', __('Import successful!'));
    }
}
