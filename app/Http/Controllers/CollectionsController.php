<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function servicesView()
    {
        return view('pages.collections.services');
    }

    public function getServices()
    {
        try {
            $data = Service::orderBy('name','ASC')->paginate(10);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}
