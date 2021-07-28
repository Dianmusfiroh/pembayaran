<?php

namespace App\Imports;

use App\Entities\Cluster;
use App\Entities\Institute;
use App\Entities\JenjangPendidikan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InstansiImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $rows;
    public function model(array $row)
    {
        ++$this->rows;
        $jenjang = JenjangPendidikan::updateOrCreate([
            'name' => strtoupper($row['jenjang']),
            'description' => '-',
            'author_id' => Auth::user()->id
        ]);
        $kluster = Cluster::updateOrCreate([
            'name' => strtoupper($row['kategori'])
        ]);
        return new Institute([
            'npsn' => $row['npsn'],
            'name' => strtoupper($row['instansi']),
            'address' => $row['alamat'],
            'educational_stage_id' => $jenjang->id,
            'province_id' => 1,
            'districts_id' => 1,
            'sub_districts_id' => $row['idkecamatan'],
            'cluster_id' =>$kluster->id,
            'author_id' => Auth::user()->id
        ]);
        
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
