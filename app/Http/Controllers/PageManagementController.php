<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageManagement\PageRequest;
use App\Models\Content;
use App\Models\Element;
use App\Models\Page;
use Illuminate\Http\Request;

class PageManagementController extends Controller
{
    public function indexView()
    {
        return view('pages.pages.index');
    }

    public function contentManagerView($slug)
    {
        return view('pages.pages.content-manager', ['slug' => $slug]);
    }

    public function getPages()
    {
        try {
            $data = Page::with(['user'])->orderBy('title', 'ASC')->paginate(10);
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

    public function submitPage(PageRequest $request)
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

    public function getContents(Page $page)
    {
        try {
            $elements = Element::all();
            $page = $page->load('contents');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'elements' => $elements,
                'page' => $page
            ]
        ], 200);
    }

    public function submitContent(Request $request)
    {
        try {
            Content::updateOrCreate(
                ['id' => $request->id],
                [
                    'page_id' => $request->page_id,
                    'element_id' => $request->element_id,
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'text' => $request->text,
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
            'message' => 'Content submitted successfully'
        ], 200);
    }

    public function deleteContent($id)
    {
        try {
            Content::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Content deleted successfully'
        ], 200);
    }
}
