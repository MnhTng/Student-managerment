<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class MemberImport
{
    public function model(Request $request, string $locale = 'vi')
    {
        // $filePath = $request->file('file')->getRealPath();

        // $reader = ReaderEntityFactory::createXLSXReader();
        // $reader->open($filePath);

        // $data = [];
        // foreach ($reader->getSheetIterator() as $sheet) {
        //     foreach ($sheet->getRowIterator() as $rowIndex => $row) {
        //         if ($rowIndex === 1) {
        //             continue;
        //         }

        //         $cells = $row->toArray();

        //         $data[] = [
        //             'kyHoc' => $cells[0] ?? null,
        //             'khoa' => $cells[1] ?? null,
        //             'ky' => $cells[2] ?? null,
        //             'nganh' => $cells[3] ?? null,
        //             'chuyenNganh' => $cells[4] ?? null,
        //             'maKhoi' => $cells[5] ?? null,
        //             'maMon' => $cells[6] ?? null,
        //             'tenMonHoc' => $cells[7] ?? null,
        //             'soTinChi' => $cells[8] ?? null,
        //             'dktq' => $cells[9] ?? null,
        //         ];
        //     }
        // }

        // $reader->close();

        // dd($data);
    }
}
