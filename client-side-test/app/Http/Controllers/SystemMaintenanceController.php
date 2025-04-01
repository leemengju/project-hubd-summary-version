<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SystemMaintenanceController extends Controller
{
    public function showMaintenance()
    {
        $data = DB::table('maintenance')->get();
    

        return response()->json([
            'data' => $data
        ]);
    }
}  