<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = [];

        $search = $request->input('s') ? $request->input('s') : null;

        $query_options = Option::with([]);

        if ($search) {
            $query_options = $query_options->where('option_name', 'like', '%' . $search . '%');
        }

        $query_options = $query_options->paginate(5);

        $data['options'] = $query_options;

        return view('admin.option.index', $data);
    }

    public function create()
    {
        $data = [];

        return view('admin.option.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option_name' => 'required|unique:options,option_name',
            'option_value' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data_store = [];

            $data_store['option_name'] = $request->input('option_name');
            $data_store['option_value'] = $request->input('option_value');
            $data_store['creted_at'] = now();
            $data_store['updated_at'] = now();

            Option::create($data_store);

            DB::commit();

            return redirect()->route('admin-option')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $option = Option::whereIn('id', [$id])->first();

        if ($option) {
            $data = [];

            $data['option'] = Option::whereIn('id', [$id])->first();

            return view('admin.option.edit', $data);
        } else {
            return redirect()->route('admin-option')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $id)
    {
        $option = Option::whereIn('id', [$id])->first();

        if ($option) {
            $validator = Validator::make($request->all(), [
                'option_name' => 'required',
                'option_value' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $data_update = [];

                $data_update['option_name'] = $request->input('option_name');
                $data_update['option_value'] = $request->input('option_value');
                $data_update['updated_at'] = now();

                Option::where('id', $id)->update($data_update);

                DB::commit();

                return redirect()->route('admin-option')->with('success', 'Data berhasil diupdate.');
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal memperbarui data.')->withInput();
            }
        } else {
            return redirect()->route('admin-option')->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $option = Option::whereIn('id', [$id])->first();

        if ($option) {
            DB::beginTransaction();

            try {
                Option::where('id', $id)->delete();

                DB::commit();

                return redirect()->route('admin-option')->with('success', 'Data berhasil dihapus.');
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Gagal menghapus data')->withInput();
            }
        } else {
            return redirect()->route('admin-option')->with('error', 'Data tidak ditemukan.');
        }
    }
}
