<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(){
        // dd('index is called');
        $pageLimit = request()->input('limit') ?? 10;
        $orderByColumn = request()->input('sort_by_col');
        $orderByType = request()->input('sort_type');
        $status = request()->input('status');
        $fields = request()->input('fields');
        $with = ['user'];
        $condition = [];
        $data = Payment::query();

        if (request()->has('search') && request()->input('search')) {
            $searchKey = request()->input('search');
            $data = $data->where(function ($q) use ($searchKey) {
                $q->whereHas('user', function ($query) use ($searchKey) {
                    $query->where('mobile', 'like', '%' . $searchKey . '%');
                })
                ->orWhereHas('user', function ($query) use ($searchKey) {
                    $query->where('name', 'like', '%' . $searchKey . '%');
                })
                ->orWhere('date', 'like', '%' . $searchKey . '%')
                ->orWhere('amount', 'like', '%' . $searchKey . '%');
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
        $with = [];
        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = Payment::where('slug', $slug)
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
            'date' => ['required'],
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

        $data = new Payment();
        $data->date = request()->date;
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
        $data = Payment::where('slug', $slug)->first();
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }
        // dd($data, request()->all());
        $validator = Validator::make(request()->all(), [
            'date' => ['required'],
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

        $data->date = request()->date;
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
            'slug' => ['required', 'exists:holidays,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Payment::where('slug',request()->slug)->first();
        $data->status = "inactive";
        $data->save();

        return response()->json([
            'status' => 'success',
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $data = Payment::where('slug',request()->slug)->first();
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
            'slug' => ['required', 'exists:holidays,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Payment::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

}
