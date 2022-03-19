<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\CouponImport;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function __construct(){
        ini_set('max_execution_time', 600);
        ini_set('memory_limit', '60m');
    }

    public function importCoupons()
    {
        Excel::import(new CouponImport(), 'coupons.xlsx');

        dd('Done');
//        return back()->withSuccess('تم تحديث بيانات الطلاب بنجاح');
    }

    public function importStudents(Request $request)
    {
        if (is_null($request->file_path)){
            return back()->withError('يجب عليك إرفاق الملف المطلوب');
        }

        if ($request->section == '0'){
            return back()->withError('يجب عليك تحديد القسم المطلوب');
        }

        Excel::import(new StudentImport($request->section), $request->file_path);

        return back()->withSuccess('تم تحديث بيانات الطلاب بنجاح');
    }

    public function showImportStudents()
    {
        return view('dashboard.import-export.students');
    }

}
