<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\CommuneImport;
use App\Imports\DistrictImport;
use App\Imports\ProvinceImport;
use Maatwebsite\Excel\Facades\Excel;

class DataController extends Controller
{
    /**
     * view import file
     *
     * @return Response
     */
    public function import()
    {
        return view('admin.file.import');
    }
    /**
     * add data from excel
     *
     * @return Response
     */
    public function store(){
        Excel::import(new ProvinceImport,'import/tinh.xlsx');
        Excel::import(new DistrictImport,'import/huyen.xlsx');
        Excel::import(new CommuneImport,'import/xa.xlsx');
        return redirect()
                ->route('admin.import')
                ->with('message', 'Add data successfully');
    }
}
