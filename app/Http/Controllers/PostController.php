<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
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

        $search = $request->input('s') ? $request->input('s') : NULL;
        $status = $request->input('status') ?? false;

        $query_posts = Post::with(['user', 'user_editor', 'media']);

        if($search){

            $query_posts = $query_posts->where('title', 'like', '%' . $search . '%');

        }

        if($status){

            if($status != 'all'){

                $query_posts = $query_posts->whereIn('status', [$status]);

            }

        }

        $query_posts = $query_posts->paginate(5);

        $data['posts'] = $query_posts;
        $data['posts_publish'] = Post::whereIn('status', [1])->count();
        $data['posts_draft'] = Post::whereIn('status', [2])->count();
        $data['posts_trash'] = Post::whereIn('status', [3])->count();

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
            $data_store['type'] = 'post';
            $data_store['status'] = $request->input('status');
            $data_store['user_id'] = Auth::user()->id;
            $data_store['user_editor_id'] = Auth::user()->id;
            $data_store['image_id'] = $request->input('image');

            if($request->input('status') == 1){

                $data_store['creted_at'] = now();

            }
            
            $data_store['updated_at'] = now();

            Post::create($data_store);

            DB::commit();

            return redirect()->route('admin-post')->with('success', 'Data success disimpan.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Failed menyimpan data')->withInput();
        }
    }

    public function edit(Request $request, $id)
    {

        $post = Post::whereIn('id', [$id])->first();

        if ($post) {

            $data = [];

            $data['post'] = Post::with(['media'])->whereIn('id', [$id])->first();
            $data['users'] = User::get();

            return view('admin.post.edit', $data);
        } else {

            return redirect()->route('admin-post')->with('error', 'Data not found.');
        }
    }

    public function update(Request $request, $id)
    {

        $post = Post::whereIn('id', [$id])->first();

        if ($post) {

            $post_id = $post->id;
            $created_at = $post->created_at;

            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {

                $data_update = [];

                $data_update['title'] = $request->input('title');
                $data_update['slug'] = $request->input('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('title'));
                $data_update['content'] = $request->input('content');
                $data_update['status'] = $request->input('status');
                $data_update['image_id'] = $request->input('image');
                $data_update['user_id'] = $request->input('user');
                $data_update['user_editor_id'] = $request->input('user_editor');

                if($request->input('status') == 1){

                    if(!$created_at){
                        $data_update['created_at'] = now();
                    }

                }
                
                $data_update['updated_at'] = now();

                Post::where('id', $id)->update($data_update);

                DB::commit();

                return redirect()->route('admin-post-edit', ['id' => $post_id])->with('success', 'Data success diupdate.');
            } catch (\Exception $e) {

                DB::rollBack(); 

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Failed update data.')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data not found.');

        }
    }

    public function trash($id)
    {
        $post = Post::whereIn('id', [$id])->first();

        if ($post) {

            $post_id = $post->id;

            DB::beginTransaction();

            try {

                $data_update = [];
                $data_update['status'] = 3;
                $data_update['created_at'] = NULL;

                Post::where('id', $post_id)->update($data_update);

                DB::commit();

                return redirect()->route('admin-post')->with('success', 'Data success di trash.');
            } catch (\Exception $e) {

                DB::rollBack(); 

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Failed update data.')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data not found.');

        }
    }

    public function restore($id)
    {
        $post = Post::whereIn('id', [$id])->first();

        if ($post) {

            $post_id = $post->id;

            DB::beginTransaction();

            try {

                $data_update = [];
                $data_update['status'] = 2;

                Post::where('id', $post_id)->update($data_update);

                DB::commit();

                return redirect()->route('admin-post')->with('success', 'Data success di restore.');
            } catch (\Exception $e) {

                DB::rollBack(); 

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Failed update data.')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data not found.');

        }
    }

    public function destroy($id)
    {
        $post = Post::whereIn('id', [$id])->first();

        if ($post) {

            $post_id = $post->id;

            DB::beginTransaction();

            try {

                Post::where('id', $post_id)->delete();

                DB::commit();

                return redirect()->route('admin-post')->with('success', 'Data success di destroy.');
            } catch (\Exception $e) {

                DB::rollBack(); 

                Log::error($e->getMessage());

                return redirect()->back()->with('error', 'Failed destroy data.')->withInput();
            }
        }else{

            return redirect()->route('admin-role')->with('error', 'Data not found.');

        }
    }
}
