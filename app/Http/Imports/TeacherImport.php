<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\Teacher;

class TeacherImport
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

                if (count($cells) < 7 || str_contains($cells[0], 'mgv')) {
                    continue;
                }
                if (Str::length($cells[0]) > 10 || Str::length($cells[1]) > 100) {
                    return back()->with('error', __('Invalid teacher format!'));
                } else if ((Str::contains($cells[5], '-') && !preg_match('/^0[1-9]{1}[0-9]{2}-[0-9]{3}-[0-9]{3}$/', $cells[5])) || !preg_match('/^0[1-9]{1}[0-9]{8}$/', $cells[5]) || Str::length($cells[5]) > 15) {
                    return back()->with('error', __('Invalid phone number format!'));
                } else if (!filter_var($cells[6], FILTER_VALIDATE_EMAIL)) {
                    return back()->with('error', __('Invalid email format!'));
                }

                $data[] = [
                    'mgv' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'name' => Str::title(Str::trim(Str::replace('"', '', $cells[1]))),
                    'birthday' => is_string($cells[2]) ? Str::replace('"', '', $cells[2]) : Carbon::parse($cells[2])->format('Y-m-d'),
                    'gender' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[3]))),
                    'address' => Str::title(Str::trim(Str::replace('"', '', $cells[4]))),
                    'phone' => Str::trim(Str::replace('"', '', Str::replace('-', '', $cells[5]))),
                    'email' => Str::lower(Str::trim(Str::replace('"', '', $cells[6]))),
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
                    $teacher = Teacher::find($row['mgv']);

                    if ($teacher) {
                        $teacher->name = $row['name'];
                        $teacher->birthday = $row['birthday'];
                        $teacher->gender = $row['gender'];
                        $teacher->address = $row['address'];
                        $teacher->phone = $row['phone'];
                        $teacher->email = $row['email'];
                        $teacher->updated_at = $row['updated_at'];
                        $teacher->save();
                    } else {
                        Teacher::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('teacher.index')->with('success', __('Import successful!'));
    }
}
