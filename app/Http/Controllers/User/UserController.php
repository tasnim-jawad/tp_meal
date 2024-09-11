<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        // dd('index is called');
        $pageLimit = request()->input('limit') ?? 10;
        $orderByColumn = request()->input('sort_by_col');
        $orderByType = request()->input('sort_type');
        $status = request()->input('status');
        $fields = request()->input('fields');
        $with = ['user_role'];
        $condition = [];
        $data = User::query();

        if (request()->has('search') && request()->input('search')) {
            $searchKey = request()->input('search');
            $data = $data->where(function ($q) use ($searchKey) {
                $q->where('name','like', '%' . $searchKey . '%')
                ->orWhere('mobile', 'like', '%' . $searchKey . '%')
                ->orWhere('email', 'like', '%' . $searchKey . '%')
                ->orWhere('gender', 'like', '%' . $searchKey . '%');
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

        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = User::where('slug', $slug)
            ->select($select)
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
                    'user' => [],
                ],
            ], 404);
        }
    }
    public function store()
    {
        // dd(request()->all(),auth()->user(),request()->password);
        $validator = Validator::make(request()->all(), [
            'user_role_serial' => ['required'],
            'department_id' => ['sometimes','required'],
            'batch_id' => ['sometimes','required'],
            'name' => ['required'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email'),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
            'gender' => ['required'],
            'mobile' => [
                'nullable',
                Rule::unique('users', 'mobile'),
            ],
            'whatsapp' => ['nullable'],
            'telegram' => ['nullable'],
            'address' => ['required'],
            'password' => ['required','confirmed','min:8'],
            'status' => ['required'],
        ])->after(function ($validator) {
            $data = request()->all();
            if (empty($data['mobile']) && empty($data['email'])) {
                $validator->errors()->add('mobile', 'Either mobile or email is required.');
                $validator->errors()->add('email', 'Either mobile or email is required.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $randomNumber = rand(1000, 9999);
        $slug = Str::slug(request()->name) . '-' . $randomNumber;



        $data = new User();
        $data->user_role_serial = request()->user_role_serial;
        $data->department_id = request()->department_id ?? null;
        $data->batch_id = request()->batch_id ?? null;
        $data->name = request()->name;
        $data->email = request()->email ?? null;
        if (request()->hasFile('image')) {
            $image_file_path = upload_image(request()->image,request()->name , null);
            $data->image = $image_file_path;
        }
        $data->gender = request()->gender;
        $data->mobile = request()->mobile ?? null;
        $data->whatsapp = request()->whatsapp ?? null;
        $data->telegram = request()->telegram ?? null;
        $data->address = request()->address ?? null;
        $data->password = Hash::make(request()->password);

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
        $data = User::where('slug', $slug)->first();
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }
        // dd($data, request()->all());
        $validator = Validator::make(request()->all(), [
            'user_role_serial' => ['required'],
            'department_id' => ['sometimes','required'],
            'batch_id' => ['sometimes','required'],
            'name' => ['required'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($data->id),
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
            'gender' => ['required'],
            'mobile' => [
                'nullable',
                Rule::unique('users', 'mobile')->ignore($data->id),
            ],
            'whatsapp' => ['nullable'],
            'telegram' => ['nullable'],
            'address' => ['required'],
            'password' => ['required','confirmed','min:8'],
            'status' => ['required'],
        ])->after(function ($validator) {
            $data = request()->all();
            if (empty($data['mobile']) && empty($data['email'])) {
                $validator->errors()->add('mobile', 'Either mobile or email is required.');
                $validator->errors()->add('email', 'Either mobile or email is required.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->user_role_serial = request()->user_role_serial;
        $data->department_id = request()->department_id ?? null;
        $data->batch_id = request()->batch_id ?? null;
        $data->name = request()->name;
        $data->email = request()->email ?? null;
        if (request()->hasFile('image')) {
            $image_file_path = upload_image(request()->image, request()->name , $data->image );
            $data->image = $image_file_path;
        }
        $data->gender = request()->gender;
        $data->mobile = request()->mobile ?? null;
        $data->whatsapp = request()->whatsapp ?? null;
        $data->telegram = request()->telegram ?? null;
        $data->address = request()->address ?? null;
        $data->password = Hash::make(request()->password);

        $data->slug = $slug;
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
            'slug' => ['required', 'exists:users,slug'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = User::where('slug',request()->slug)->first();
        $data->status = 0;
        $data->save();

        return response()->json([
            'status' => 'success',
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $data = User::where('slug',request()->slug)->first();
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
            'id' => ['required', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = User::find(request()->id);
        $data->status = 1;
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

}
