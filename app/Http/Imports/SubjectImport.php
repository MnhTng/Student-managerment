<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\Subject;

class SubjectImport
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

                if (count($cells) < 3 || str_contains($cells[0], 'subject_code')) {
                    continue;
                }
                if (!preg_match('/[A-Za-z]{3,4}[0-9]{3,6}/', $cells[0])) {
                    return back()->with('error', __('Invalid subject format!'));
                }

                $data[] = [
                    'subject_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'subject_name' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[1]))),
                    'credit' => Str::trim(Str::replace('"', '', $cells[2])),
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
                    $subject = Subject::find($row['subject_code']);

                    if ($subject) {
                        $subject->subject_name = $row['subject_name'];
                        $subject->credit = $row['credit'];
                        $subject->updated_at = $row['updated_at'];
                        $subject->save();
                    } else {
                        Subject::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('subject.index')->with('success', __('Import successful!'));
    }
}
