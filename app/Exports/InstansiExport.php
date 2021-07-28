<?php

namespace App\Exports;

use App\Entities\Institute;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class InstansiExport implements FromCollection,WithHeadings,WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $institutes = Institute::all();
        $datas = [];
        if ($institutes->count() > 0) {
            foreach ($institutes as $item) {
                $datas[] = [
                    'npsn' => $item->npsn,
                    'instansi' => $item->name,
                    'alamat' => $item->address,
                    'jenjang' => $item->educational_stage->name,
                    'kecamatan' => $item->sub_districts->name,
                    'klaster' => $item->cluster->name,  
                ];
            }
        }
        return collect($datas);
    }

    public function headings(): array
    {
        return [
            'npsn',
            'instansi',
            'alamat',
            'jenjang',
            'kecamatan',
            'klaster'
        ];
    }

    public function title(): string
    {
        return "Instansi";
    }
}
