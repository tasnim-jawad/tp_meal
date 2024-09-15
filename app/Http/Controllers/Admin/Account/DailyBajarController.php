<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Admin\Account\DailyBajar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DailyBajarController extends Controller
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
        $data = DailyBajar::query();

        if (request()->has('search') && request()->input('search')) {
            $searchKey = request()->input('search');
            $data = $data->where(function ($q) use ($searchKey) {
                $q->where('date','like', '%' . $searchKey . '%')
                ->orWhere('title', 'like', '%' . $searchKey . '%')
                ->orWhere('total', 'like', '%' . $searchKey . '%')
                ->orWhere('price', 'like', '%' . $searchKey . '%')
                ->orWhere('comment', 'like', '%' . $searchKey . '%')
                ->orWhere('qty', 'like', '%' . $searchKey . '%')
                ->orWhere('unit', 'like', '%' . $searchKey . '%');
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

    public function date_wise_bajar(){
        // dd('index is called');
        // dd(request()->all());
        $month = '';
        $year = '';

        if (request()->input('month') != null) {
            $search_month = request()->input('month');
            $carbonDate = Carbon::parse($search_month);
            $month = $carbonDate->month;
            $year = $carbonDate->year;

        }else{
            $now =Carbon::now();
            $month =$now->month;
            $year =$now->year;
        }

        // $data = DailyBajar::whereMonth('date',$month)->whereYear('date',$year);

        // if (request()->has('search') && request()->input('search')) {
        //     $searchKey = request()->input('search');
        //     $data = $data->where(function ($q) use ($searchKey) {
        //         $q->where('date','like', '%' . $searchKey . '%')
        //         ->orWhere('title', 'like', '%' . $searchKey . '%')
        //         ->orWhere('total', 'like', '%' . $searchKey . '%')
        //         ->orWhere('price', 'like', '%' . $searchKey . '%')
        //         ->orWhere('comment', 'like', '%' . $searchKey . '%')
        //         ->orWhere('qty', 'like', '%' . $searchKey . '%')
        //         ->orWhere('unit', 'like', '%' . $searchKey . '%');
        //     });
        // }

        $data = DailyBajar::select(DB::raw('DATE(date) as date'), DB::raw('SUM(total) as daily_total'))
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy(DB::raw('DATE(date)'), 'desc')
            ->get();

        $monthly_total = DailyBajar::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('total');

        return response()->json([
            'status' => 'success',
            'data' => $data,
            'monthly_total' => $monthly_total
        ]);
    }

    public function show($slug)
    {
        $with = [];
        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = DailyBajar::where('slug', $slug)
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
            'title' => ['required'],
            'qty' => ['required'],
            'unit' => ['required'],
            'price' => ['required'],
            'total' => ['required'],
            'date' => ['required'],
            'comment' => ['nullable'],
            'status' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $randomNumber = rand(1000, 9999);
        $slug = Str::slug(request()->title) . '-' . $randomNumber;

        $data = new DailyBajar();
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
        $data = DailyBajar::where('slug', $slug)->first();
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

        $data = DailyBajar::where('slug',request()->slug)->first();
        $data->status = "inactive";
        $data->save();

        return response()->json([
            'status' => 'success',
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $data = DailyBajar::where('slug',request()->slug)->first();
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

        $data = DailyBajar::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

    public function import(){
        $data = request()->input('data');
        // dd(request()->all()['data']['data'],$data['data'] ,$data['date'] );

        $date = $data['date'];
        $all_data = $data['data'];

        $randomNumber_group = rand(1000, 9999);
        $randomNumber_slug = rand(1000, 9999);
        // $slug = Str::slug(request()->title) . '-' . $randomNumber;

        foreach ($all_data as $row) {
            DailyBajar::create([
                "group_id" => $randomNumber_group,
                "title" => $row['title'],
                "qty" => $row['qty'],
                "unit" => $row['unit'],
                "price" => $row['price'],
                "total" => $row['total'],
                "comment" => $row['comment'],
                "date" => $date,
                "slug" => Str::slug($row['title']). '_' . $randomNumber_slug,
                "creator" => auth()->id(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'result' => 'Items imported successfully',
        ], 200);

    }

}
