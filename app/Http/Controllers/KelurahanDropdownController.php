<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KelurahanDropdownController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $kecamatan = Kecamatan::findOrFail($request->id);
        $kelurahanFiltered = $kecamatan->kelurahan->pluck('name', 'id');
        return response()->json($kelurahanFiltered);
    }
}
