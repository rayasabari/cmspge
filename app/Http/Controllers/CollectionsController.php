<?php

namespace App\Http\Controllers;

use App\Http\Requests\Collections\AchievementRequest;
use App\Http\Requests\Collections\ExpertiseRequest;
use App\Http\Requests\Collections\ServiceRequest;
use App\Http\Requests\Collections\StaffRequest;
use App\Http\Requests\Collections\ValueRequest;
use App\Models\Achievement;
use App\Models\Expertise;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Value;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function servicesView()
    {
        return view('pages.collections.services');
    }

    public function staffView()
    {
        return view('pages.collections.staff');
    }

    public function expertiseView()
    {
        return view('pages.collections.expertise');
    }

    public function valuesView()
    {
        return view('pages.collections.values');
    }

    public function achievementsView()
    {
        return view('pages.collections.achievements');
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

    public function getStaff()
    {
        try {
            $data = Staff::orderBy('name', 'ASC')->paginate(10);
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

    public function submitStaff(StaffRequest $request)
    {
        try {
            Staff::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'position' => $request->position,
                    'bio' => $request->bio,
                    'image' => $request->image,
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
            'message' => 'Staff successfully saved!'
        ], 200);
    }

    public function deleteStaff($id)
    {
        try {
            Staff::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Staff successfully deleted!'
        ], 200);
    }

    public function getExpertises()
    {
        try {
            $data = Expertise::orderBy('name', 'ASC')->paginate(10);
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

    public function submitExpertise(ExpertiseRequest $request)
    {
        try {
            Expertise::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'url' => $request->url,
                    'image' => $request->image,
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
            'message' => 'Expertise successfully saved!'
        ], 200);
    }

    public function deleteExpertise($id)
    {
        try {
            Expertise::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Expertise successfully deleted!'
        ], 200);
    }

    public function getValues()
    {
        try {
            $data = Value::orderBy('name', 'ASC')->paginate(10);
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

    public function submitValue(ValueRequest $request)
    {
        try {
            Value::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $request->image,
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
            'message' => 'Value successfully saved!'
        ], 200);
    }

    public function deleteValue($id)
    {
        try {
            Value::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Value successfully deleted!'
        ], 200);
    }

    public function getAchievements()
    {
        try {
            $data = Achievement::orderBy('name', 'ASC')->paginate(10);
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

    public function submitAchievement(AchievementRequest $request)
    {
        try {
            Achievement::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'image' => $request->image,
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
            'message' => 'Achievement successfully saved!'
        ], 200);
    }

    public function deleteAchievement($id)
    {
        try {
            Achievement::destroy($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Achievement successfully deleted!'
        ], 200);
    }
}
