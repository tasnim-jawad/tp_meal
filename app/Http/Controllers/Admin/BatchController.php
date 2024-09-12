<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    public function index(){
        // dd('index is called');
        $pageLimit = request()->input('limit') ?? 10;
        $orderByColumn = request()->input('sort_by_col');
        $orderByType = request()->input('sort_type');
        $status = request()->input('status');
        $fields = request()->input('fields');
        $with = ['department'];
        $condition = [];
        $data = Batch::query();

        if (request()->has('search') && request()->input('search')) {
            $searchKey = request()->input('search');
            $data = $data->where(function ($q) use ($searchKey) {
                $q->where('title','like', '%' . $searchKey . '%')
                ->orWhere('description', 'like', '%' . $searchKey . '%');
            });
        }

        if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
            $data = $data
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->limit($pageLimit)
                ->orderBy($orderByColumn, $orderByType)
                ->get();
        } else {
            $data = $data
                ->with($with)
                ->select($fields)
                ->where($condition)
                ->where('status', $status)
                ->orderBy($orderByColumn, $orderByType)
                ->paginate($pageLimit);
        }

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function show($slug)
    {
        $with = ['department'];
        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = Batch::where('slug', $slug)
            ->select($select)
            ->with($with)
            ->first();
        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ],200);
        } else {
            return response()->json([
                'err_message' => 'data not found',
                'errors' => [
                    'data' => [],
                ],
            ], 404);
        }
    }
    public function store()
    {
        // dd(request()->all(),auth()->user(),request()->password);
        $validator = Validator::make(request()->all(), [
            'department_id' => ['required'],
            'title' => ['required'],
            'description' => ['nullable'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $randomNumber = rand(1000, 9999);
        $slug = Str::slug(request()->title) . '-' . $randomNumber;

        $data = new Batch();
        $data->department_id = request()->department_id;
        $data->title = request()->title;
        $data->description = request()->description ?? null;

        $data->slug = $slug;
        $data->creator = auth()->id();
        $data->status = request()->status ?? 'active';
        $data->save();

        return response()->json($data, 200);
    }

    public function update($slug)
    {
        // dd($data, request()->all());
        // dd(request()->all(),$slug);
        $data = Batch::where('slug', $slug)->first();
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }
        // dd($data, request()->all());
        $validator = Validator::make(request()->all(), [
            'department_id' => ['required'],
            'title' => ['required'],
            'description' => ['nullable'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->department_id = request()->department_id;
        $data->title = request()->title;
        $data->description = request()->description ?? null;

        $data->creator = auth()->id();
        $data->status = request()->status ?? 'active';
        $data->update();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ],200);

    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'slug' => ['required', 'exists:batches,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Batch::where('slug',request()->slug)->first();
        $data->status = "inactive";
        $data->save();

        return response()->json([
            'status' => 'success',
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $data = Batch::where('slug',request()->slug)->first();
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given slug ' . (request()->slug ? request()->slug : 'null')]],
            ], 422);
        }
        $data->delete();

        return response()->json([
            'status' => 'success',
            'result' => 'Item Successfully deleted'
        ],200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'slug' => ['required', 'exists:batches,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Batch::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

}
