<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data = [];

        $search = $request->input('s') ? $request->input('s') : null;

        $query_roles = Role::with(['users']);

        if($search){

            $query_roles = $query_roles->where('name', 'like', '%' . $search . '%');

        }

        $query_roles = $query_roles->paginate(5);

        $data['roles'] = $query_roles;

        return view('admin.role.index', $data);
        
    }

    public function create()
    {

        return view('admin.role.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $data_store = [];

            $data_store['name'] = $request->input('name');
            $data_store['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
            $data_store['creted_at'] = now();
            $data_store['updated_at'] = now();

            Role::create($data_store);

            DB::commit();

            return redirect()->route('admin-role')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
        }
    }

    public function edit(Request $request, $id)
    {

        $role = Role::whereIn('id', [$id])->first();

        if ($role) {

            $data = [];

            $data['role'] = Role::whereIn('id', [$id])->first();

            return view('admin.role.edit', $data);
        } else {

            return redirect()->route('admin-role')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {

        $role = Role::whereIn('id', [$id])->first();

        if ($role) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {

                $data_update = [];

                $data_update['name'] = $request->input('name');
                $data_update['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
                $data_update['updated_at'] = now();

                Role::where('id', $id)->update($data_update);

                DB::commit();

                return redirect()->route('admin-role')->with('success', 'Data berhasil diupdate.');
            } catch (\Exception $e) {

                DB::rollBack(); 

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal memperbarui data.')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data tidak ditemukan.');

        }
    }

    public function destroy(Request $request, $id)
    {
        $role = Role::whereIn('id', [$id])->first();

        if ($role) {

            DB::beginTransaction();

            try {                

                Role::where('id', $id)->delete();

                DB::commit();

                return redirect()->route('admin-role')->with('success', 'Data berhasil dihapus.');
            } catch (\Exception $e) {

                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal menghapus data')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data tidak ditemukan.');

        }
    }
}
