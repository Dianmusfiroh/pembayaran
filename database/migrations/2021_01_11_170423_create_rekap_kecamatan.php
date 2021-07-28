<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapKecamatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     DB::statement($this->dropView());

    //     DB::statement($this->createView());
    // }

    // private function createView(): string
    // {
    //     return <<<SQL
        // CREATE VIEW `rekap_kecamatan` AS

        // SELECT kec.name kecamatan, DATE_FORMAT(inv.invoice_date,'%Y') tahun_anggaran, inv.step tahap,
        // pc.name kategori,jenjang.name jenjang,jenjang.id jenjang_id,invp.period periode,invd.jumlah_bayar jumlah_bayar
        // FROM invoice inv
        // LEFT JOIN invoice_details invd ON (inv.id = invd.invoice_id)
        // LEFT JOIN invoice_period invp ON (inv.id = invp.invoice_id)
        // JOIN gtt ON (gtt.id = invd.gtt_id)
        // LEFT JOIN institute sek ON (sek.id = gtt.institute_id)
        // LEFT JOIN sub_districts kec ON (kec.id = sek.sub_districts_id)
        // LEFT JOIN educational_stage jenjang ON (jenjang.id = sek.educational_stage_id)
        // LEFT JOIN position p ON (p.id = gtt.position_id)
        // LEFT JOIN position_categories pc ON (pc.id = p.position_category_id)
        // GROUP BY kec.id,invp.id,jenjang.id,pc.id
    //     SQL;
    // }

    /**
     * Reverse the migrations.
     *
    //  * @return void
    //  */
    // private function dropView()
    // {
    //     return <<<SQL
    //         DROP VIEW IF EXISTS `rekap_kecamatan`;
    //         SQL;
    // }
}
