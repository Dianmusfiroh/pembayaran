<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AssessmentExport implements FromCollection,WithTitle,WithHeadings
{

    protected $slug;
    protected $kat_id;
    public function __construct($slug,$kat_id)
    {
        $this->slug = $slug;
        $this->kat_id = $kat_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $prints  = DB::select(DB::raw("SELECT 
                    `assesment`.id,
                    (SELECT 
                            `nik`
                        FROM
                            `candidate_profile`
                        WHERE
                            `user_id` = `assesment`.`candidate_id`
                        ORDER BY `id` DESC
                        LIMIT 1) AS `nik`,
                    (SELECT 
                            `full_name`
                        FROM
                            `candidate_profile`
                        WHERE
                            `user_id` = `assesment`.`candidate_id`
                        ORDER BY `id` DESC
                        LIMIT 1) AS `full_name`,
                    (SELECT 
                            `position`.`name`
                        FROM
                            `formation`
                                INNER JOIN
                            `formation_needs` ON `formation`.`formation_needs_id` = `formation_needs`.`id`
                                INNER JOIN
                            `position` ON `formation_needs`.`position_id` = `position`.`id`
                        WHERE
                            `formation`.`id` = `assesment`.`formation_id`
                        ORDER BY `formation`.`id` DESC
                        LIMIT 1) AS `jabatan`,
                    (SELECT 
                            `institute`.`npsn`
                        FROM
                            `formation`
                                INNER JOIN
                            `formation_needs` ON `formation`.`formation_needs_id` = `formation_needs`.`id`
                                INNER JOIN
                            `institute` ON `formation_needs`.`institute_id` = `institute`.`id`
                        WHERE
                            `formation`.`id` = `assesment`.`formation_id`
                        ORDER BY `formation`.`id` DESC
                        LIMIT 1) AS `npsn`,
                    (SELECT 
                            `institute`.`name`
                        FROM
                            `formation`
                                INNER JOIN
                            `formation_needs` ON `formation`.`formation_needs_id` = `formation_needs`.`id`
                                INNER JOIN
                            `institute` ON `formation_needs`.`institute_id` = `institute`.`id`
                        WHERE
                            `formation`.`id` = `assesment`.`formation_id`
                        ORDER BY `formation`.`id` DESC
                        LIMIT 1) AS `instansi`,
                    (SELECT 
                            `educational_stage`.`name`
                        FROM
                            `formation`
                                INNER JOIN
                            `formation_needs` ON `formation`.`formation_needs_id` = `formation_needs`.`id`
                                INNER JOIN
                            `institute` ON `formation_needs`.`institute_id` = `institute`.`id`
                                INNER JOIN
                            `educational_stage` ON `institute`.`educational_stage_id` = `educational_stage`.`id`
                        WHERE
                            `formation`.`id` = `assesment`.`formation_id`
                        ORDER BY `formation`.`id` DESC
                        LIMIT 1) AS `jenjang`
                FROM
                    `assesment`
                WHERE
                    `formation_id` IN (SELECT 
                            `id`
                        FROM
                            `formation`
                        WHERE
                            `formation_needs_id` IN (SELECT 
                                    `id`
                                FROM
                                    `formation_needs`
                                WHERE
                                    `position_id` IN (SELECT 
                                            `id`
                                        FROM
                                            `position`
                                        WHERE
                                            `position_category_id` = ".$this->kat_id.")
                                        AND `formation_category_id` = (SELECT 
                                            `id`
                                        FROM
                                            `formation_category`
                                        WHERE
                                            `slug` = '".$this->slug."')
                                ORDER BY `id` ASC)
                        AND `status_id` = 5)
                ORDER BY `score` DESC"));
        return collect($prints);
    }

    public function headings(): array
    {
        return ["NOPES", "NIK","NAMA LENGKAP","JABATAN","NPSN","NAMA SEKOLAH","JENJANG"];
    }

    public function title(): string
    {
        return "Penilaian Tahap I";
    }
}
