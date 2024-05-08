<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KecamatanDropdownController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $kabupaten = Kabupaten::findOrFail($request->id);
        $kecamatanFiltered = $kabupaten->kecamatan->pluck('name', 'id');
        return response()->json($kecamatanFiltered);
    }
}
