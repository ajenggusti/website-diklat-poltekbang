<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function index(){
        $datas = Activity::get();
        // dd($datas);
        return view('kelola.logActivity.index', [
            'datas'=>$datas
        ]);
    }
}
