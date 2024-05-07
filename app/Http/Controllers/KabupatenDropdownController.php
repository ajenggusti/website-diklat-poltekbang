<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class KabupatenDropdownController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd($request);
        $provinsi = Provinsi::findOrFail($request->id);
        // dd($provinsi);
        $kabupatenFiltered = $provinsi->kabupaten->pluck('name', 'id');
        return response()->json($kabupatenFiltered);
    }
}
