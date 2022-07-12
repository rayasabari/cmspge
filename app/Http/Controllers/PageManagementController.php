<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageManagement\AddPagesRequest;
use App\Models\Pages;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    public function indexView()
    {
        return view('pages.pages.index');
    }

    public function addView()
    {
        return view('pages.pages.add');
    }

    public function getIndex()
    {
        try {
            $data = Pages::latest()->paginate(2);
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

    public function add(AddPagesRequest $request)
    {
        try {
            Pages::create([
                'parent_id' => $request->parent_id,
                'slug' => $request->slug,
                'title' => $request->title,
                'meta_description' => $request->meta_description,
                'front_path' => $request->front_path,
                'created_by_id' => auth()->user()->id,
                'updated_by_id' => auth()->user()->id
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'data' => $request->all(),
            'status' => 'success',
            'message' => 'Page added successfully'
        ], 200);
    }
}
