<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $data = [];

        $search = $request->input('s') ? $request->input('s') : null;

        $query_posts = Post::with(['user', 'user_editor', 'image']);

        if($search){

            $query_posts = $query_posts->where('title', 'like', '%' . $search . '%');

        }

        $query_posts = $query_posts->paginate(5);

        $data['posts'] = $query_posts;

        return view('admin.post.index', $data);

    }

    public function create()
    {

        return view('admin.post.create');
    }

    public function store(Request $request)
    {

        $rules_validator = [];
        $rules_validator['title'] = 'required';

        $validator = Validator::make($request->all(), $rules_validator);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {

            $data_store = [];

            $data_store['title'] = $request->input('title');
            $data_store['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
            $data_store['content'] = $request->input('content');
            $data_store['excerpt'] = NULL;
            $data_store['status'] = 2;
            $data_store['type'] = 'post';
            $data_store['user_id'] = Auth::user()->id;
            $data_store['user_editor_id'] = Auth::user()->id;
            $data_store['image'] = $request->input('image');
            $data_store['creted_at'] = now();
            $data_store['updated_at'] = now();

            Post::create($data_store);

            DB::commit();

            return redirect()->route('admin-post')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
        }
    }
}
