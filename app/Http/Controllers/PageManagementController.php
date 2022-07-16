<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageManagement\AddPagesRequest;
use App\Http\Requests\PageManagement\PageRequest;
use App\Models\ElementType;
use App\Models\Page;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    public function indexView()
    {
        return view('pages.pages.index');
    }

    public function contentManagerView($id)
    {
        return view('pages.pages.content-manager', ['id' => $id]);
    }

    public function getIndex()
    {
        try {
            $data = Page::with(['user'])->latest()->paginate(10);
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

    public function submit(PageRequest $request)
    {
        try {
            Page::updateOrCreate(
                ['id' => $request->id],
                [
                    'parent_id' => $request->parent_id,
                    'slug' => $request->slug,
                    'title' => $request->title,
                    'meta_description' => $request->meta_description,
                    'front_path' => $request->front_path,
                    'created_by_id' => auth()->user()->id,
                    'updated_by_id' => auth()->user()->id
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'data' => $request->all(),
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'data' => $request->all(),
            'status' => 'success',
            'message' => 'Page submitted successfully'
        ], 200);
    }

    public function delete($id)
    {
        try {
            Page::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Page deleted successfully'
        ], 200);
    }

    public function getContentManagerData($id)
    {
        try {
            $elementType = ElementType::all();
            $page = Page::with('elements')->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'elementType' => $elementType,
                'page' => $page
            ]
        ], 200);
    }
}
