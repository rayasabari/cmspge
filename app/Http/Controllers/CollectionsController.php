<?php

namespace App\Http\Controllers;

use App\Http\Requests\Collections\ServiceRequest;
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
            $data = Service::orderBy('name', 'ASC')->paginate(10);
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

    public function submitService(ServiceRequest $request)
    {
        try {
            Service::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'url' => $request->url,
                    'created_by_id' => auth()->user()->id,
                    'updated_by_id' => auth()->user()->id
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Service successfully saved!'
        ], 200);
    }

    public function deleteService($id)
    {
        try {
            Service::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Service successfully deleted!'
        ], 200);
    }
}
