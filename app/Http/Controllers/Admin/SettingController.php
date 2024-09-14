<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(){
        // dd('index is called');
        $pageLimit = request()->input('limit') ?? 10;
        $orderByColumn = request()->input('sort_by_col');
        $orderByType = request()->input('sort_type');
        $status = request()->input('status');
        $fields = request()->input('fields');
        $with = [];
        $condition = [];
        $data = Setting::query();

        if (request()->has('search') && request()->input('search')) {
            $searchKey = request()->input('search');
            $data = $data->where(function ($q) use ($searchKey) {
                $q->where('address','like', '%' . $searchKey . '%')
                ->orWhere('contact_name', 'like', '%' . $searchKey . '%');
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
        $data = Setting::where('slug', $slug)
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
            'address' => ['required'],
            'contact_name' => ['required'],
            'contact_number' => ['required'],
            'meal_booking_last_time' => ['required'],
            'meal_booking_alert_time' => ['required'],
            'meal_booking_alert_text_for_all' => ['required'],
            'meal_booking_minimum_amount' => ['required'],
            'shut_down_app' => ['nullable'],
            'shut_down_reason' => ['sometimes','required'],
            'notice' => ['nullable'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        Setting::where('status', 'active')->update(['status' => 'inactive']);

        $randomNumber = rand(1000, 9999);
        $slug = Str::slug(request()->contact_number) . '-' . $randomNumber;

        $data = new Setting();
        $data->address = request()->address;
        $data->contact_name = request()->contact_name;
        $data->contact_number = request()->contact_number;
        $data->meal_booking_last_time = request()->meal_booking_last_time;
        $data->meal_booking_alert_time = request()->meal_booking_alert_time;
        $data->meal_booking_alert_text_for_all = request()->meal_booking_alert_text_for_all;
        $data->meal_booking_minimum_amount = request()->meal_booking_minimum_amount;
        $data->shut_down_app = request()->shut_down_app ?? 'active';
        $data->shut_down_reason = request()->shut_down_reason ?? null;
        $data->notice = request()->notice ?? null;

        $data->slug = $slug;
        $data->creator = auth()->id();
        $data->status = request()->status ?? 'active';
        $data->save();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ],200);
    }

    public function update($slug)
    {
        // dd($data, request()->all());
        // dd(request()->all(),$slug);
        $data = Setting::where('slug', $slug)->first();
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }
        // dd($data, request()->all());
        $validator = Validator::make(request()->all(), [
            'address' => ['required'],
            'contact_name' => ['required'],
            'contact_number' => ['required'],
            'meal_booking_last_time' => ['required'],
            'meal_booking_alert_time' => ['required'],
            'meal_booking_alert_text_for_all' => ['required'],
            'meal_booking_minimum_amount' => ['required'],
            'shut_down_app' => ['nullable'],
            'shut_down_reason' => ['sometimes','required'],
            'notice' => ['nullable'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->address = request()->address;
        $data->contact_name = request()->contact_name;
        $data->contact_number = request()->contact_number;
        $data->meal_booking_last_time = request()->meal_booking_last_time;
        $data->meal_booking_alert_time = request()->meal_booking_alert_time;
        $data->meal_booking_alert_text_for_all = request()->meal_booking_alert_text_for_all;
        $data->meal_booking_minimum_amount = request()->meal_booking_minimum_amount;
        $data->shut_down_app = request()->shut_down_app ?? 'active';
        $data->shut_down_reason = request()->shut_down_reason ?? null;
        $data->notice = request()->notice ?? null;

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
            'slug' => ['required', 'exists:settings,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Setting::where('slug',request()->slug)->first();
        $data->status = "inactive";
        $data->save();

        return response()->json([
            'status' => 'success',
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $data = Setting::where('slug',request()->slug)->first();
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
            'slug' => ['required', 'exists:settings,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Setting::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

}
