<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        $this->authorize('dpukSuperAdminKeuangan', Auth::user());
        $datas = Activity::get();
        // dd($datas);
        // $users = [];

        // foreach ($datas as $data) {
        //     if ($data->log_name == "Tabel user" && $data->description == "created") {
        //         if (isset($data->changes['attributes']['id'])) {
        //             $user = User::findOrFail($data->changes['attributes']['id']);
        //             // $users[] = $user->name;
        //         }
        //     }
        // }

        // dd($user->name); // Uncomment for debugging

        return view('kelola.logActivity.index', [
            'datas' => $datas,

        ]);
    }
}
