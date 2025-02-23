<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Exception;
use Illuminate\Support\Facades\Redirect;

use App\Models\TrainingSystem;

class TrainingSystemImport
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

                if (count($cells) < 2 || str_contains($cells[0], 'training_code')) {
                    continue;
                }
                if (strlen($cells[0]) > 10 || strlen($cells[1]) > 50) {
                    return back()->with('error', __('Invalid training system format!'));
                }

                $data[] = [
                    'training_code' => Str::upper(Str::trim(Str::replace('"', '', $cells[0]))),
                    'training_name' => Str::ucfirst(Str::trim(Str::replace('"', '', $cells[1]))),
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
                    $trainingSystem = TrainingSystem::find($row['training_code']);

                    if ($trainingSystem) {
                        $trainingSystem->training_name = $row['training_name'];
                        $trainingSystem->updated_at = $row['updated_at'];
                        $trainingSystem->save();
                    } else {
                        TrainingSystem::create($row);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error', __('Import failed!'));
            }
        }

        return Redirect::route('training-system.index')->with('success', __('Import successful!'));
    }
}
