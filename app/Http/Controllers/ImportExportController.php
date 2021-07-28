<?php

namespace App\Http\Controllers;

use App\Exports\AssessmentExport;
use App\Exports\InstansiExport;
use App\Imports\InstansiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    private $modul;
    private $export_modul;
    private $import_modul;

    public function __construct()
    {
        $this->modul = 'Import Export';
        $this->import_modul = [
            'instansi' => new InstansiImport,
        ];
        $this->export_modul = [
            'instansi' => new InstansiExport
        ];
    }

    public function index()
    {
        $modul = request()->q;
        return view('import.index', compact(['modul']));
    }

    public function export()
    {
        if (request()->q == 'hasil_penilaian_tahap_1'){
            return Excel::download(new AssessmentExport(request()->slug,request()->kat), request()->q.'_' . request()->slug.'.xlsx');
        }else{
            return Excel::download($this->export_modul[request()->q], request()->q . '.xlsx');
        }
    }

    public function import()
    {
        request()->validate([
            'file' => 'required'
        ]);
        $importModel = $this->import_modul[request()->q];
        Excel::import($importModel, request()->file('file'));
        return redirect()->back()->with(['message'=>$importModel->getRowCount().' rows berhasil di import']);
        // return response()->json(['status' => 'success', 'message' => $importModel->getRowCount() . ' row successfully imported'], '201');
    }
}
