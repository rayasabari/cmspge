<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\HomeFront;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeFrontController extends Controller
{
    public function view()
    {
        return view('pages.pages.home-front.index');
    }

    public function getData()
    {
        try {
            $data = HomeFront::findOrFail(1);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function saveData(Request $request)
    {
        try {
            $data = HomeFront::findOrFail(1);
            $data->text_title = $request->text_title;
            $data->text_description = $request->text_description;
            $data->youtube = $request->youtube;
            $data->user_update_id = Auth::user()->id;
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan'
        ], 200);
    }
}
