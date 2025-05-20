<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data = [];

        $search = $request->input('s') ? $request->input('s') : null;

        $query_users = User::with(['role']);

        if($search){

            $query_users = $query_users->where('name', 'like', '%' . $search . '%');

        }

        $query_users = $query_users->paginate(5);

        $data['users'] = $query_users;

        return view('admin.user.index', $data);
    }

    public function create()
    {
        $data = [];

        $data['roles'] = Role::get();

        return view('admin.user.create', $data);
    }

    public function store(Request $request)
    {

        $rules_validator = [];
        $rules_validator['name'] = 'required';
        $rules_validator['slug'] = 'unique:users,slug';
        $rules_validator['role'] = 'required';
        $rules_validator['email'] = 'required|email|unique:users,email';
        $rules_validator['password'] = 'required|min:8';
        $rules_validator['confirm_password'] = 'required|min:8|same:password';

        $validator = Validator::make($request->all(), $rules_validator);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $data_store = [];

            $inp_role_id = $request->input('role');

            $data_store['name'] = $request->input('name');
            $data_store['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
            $data_store['email'] = $request->input('email');
            $data_store['role_id'] = $inp_role_id;
            $data_store['password'] = bcrypt($request->input('password'));
            $data_store['created_at'] = now();
            $data_store['updated_at'] = now();

            User::create($data_store);

            $data_update_role = [];
            $data_update_role['count'] = User::where('role_id', $inp_role_id)->count();

            Role::where('id', $inp_role_id)->update($data_update_role);

            DB::commit();

            return redirect()->route('admin-user')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
        }
    }

    public function edit(Request $request, $id)
    {

        $user = User::with(['media'])->whereIn('id', [$id])->first();

        if ($user) {

            $data = [];

            $data['user'] = $user;
            $data['roles'] = Role::get();

            return view('admin.user.edit', $data);
        } else {

            return redirect()->route('admin-user')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {

        $user = User::whereIn('id', [$id])->first();

        if ($user) {

            $user_id = $user->id;
            $role_id = $user->role_id;

            $rules_validator = [];
            $rules_validator['name'] = 'required';
            $rules_validator['role'] = 'required';

            $password = $request->input('password');

            if ($password != null && $password != '') {
                $rules_validator['password'] = 'required|min:8';
                $rules_validator['confirm_password'] = 'required|min:8|same:password';
            }

            $validator = Validator::make($request->all(), $rules_validator);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {

                $data_update = [];

                $inp_role_id = $request->input('role');

                $data_update['name'] = $request->input('name');
                $data_update['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
                $data_update['email'] = $request->input('email');
                $data_update['role_id'] = $inp_role_id;
                $data_update['image_id'] = $request->input('image');
                $data_update['updated_at'] = now();

                User::where('id', $user_id)->update($data_update);

                $data_update_role_old = [];
                $data_update_role_old['count'] = User::where('role_id', $role_id)->count();

                Role::where('id', $role_id)->update($data_update_role_old);

                $data_update_role = [];
                $data_update_role['count'] = User::where('role_id', $inp_role_id)->count();

                Role::where('id', $inp_role_id)->update($data_update_role);

                DB::commit();

                return redirect()->route('admin-user')->with('success', 'Data berhasil update.');
            } catch (\Exception $e) {

                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
            }
        } else {

            return redirect()->route('admin-user')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy(Request $request, $id)
    {

        $user = User::whereIn('id', [$id])->first();

        if ($user) {

            $user_id = $user->id;
            $role_id = $user->role_id;

            DB::beginTransaction();

            try {

                User::where('id', $user_id)->delete();

                $data_update_role = [];
                $data_update_role['count'] = User::where('role_id', $role_id)->count();

                Role::where('id', $role_id)->update($data_update_role);

                DB::commit();

                return redirect()->route('admin-user')->with('success', 'Data berhasil dihapus.');
            } catch (\Exception $e) {

                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal menghapus data')->withInput();
            }
        } else {

            return redirect()->route('admin-user')->with('error', 'Data tidak ditemukan.');
        }

    }
}
