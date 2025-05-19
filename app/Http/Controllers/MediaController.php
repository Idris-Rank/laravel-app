<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];

        $per_page = 20;

        $data['medias'] = Media::take($per_page)->orderBy('id', 'desc')->get();
        $data['count_media'] = Media::count();

        return view('admin.media.index', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'upload_media.*' => 'required|file|mimes:jpg,jpeg,png,webp'
        ]);

        $medias = [];

        $input_media = $request->file('input_media');

        foreach ($input_media as $file) {

            $originalName = $file->getClientOriginalName();
            $extension     = $file->getClientOriginalExtension();
            $filenameOnly  = pathinfo($originalName, PATHINFO_FILENAME);

            $slug = Str::slug($filenameOnly);

            $directory = 'uploads';
            $counter = 1;

            $finalName = $slug . '.' . $extension;
            while (Storage::disk('public')->exists($directory . '/' . $finalName)) {
                $counter++;
                $finalName = $slug . '-' . $counter . '.' . $extension;
            }

            $path = $file->storeAs($directory, $finalName, 'public');

            if ($path) {

                $data_store = [];
                $data_store['title'] = $filenameOnly;
                $data_store['slug'] = $slug;
                $data_store['excerpt'] = NULL;
                $data_store['guid'] = asset('storage/' . $directory . '/' . $finalName);
                $data_store['type'] = $file->getMimeType();
                $data_store['filename'] = $finalName;
                $data_store['user_id'] = Auth::user()->id;
                $data_store['created_at'] = now();
                $data_store['updated_at'] = now();

                $media = Media::create($data_store);

                if ($media) {

                    $data_media = [];
                    $data_media['id'] = $media->id;
                    $data_media['title'] = $media->title;
                    $data_media['guid'] = $media->guid;
                }

                $medias[] = $data_media;
            }
        }

        $count_media = Media::count();

        return response()->json([
            'status' => true,
            'message' => 'File berhasil diupload!',
            'medias' => $medias,
            'count_media' => $count_media,
        ], 200);
    }

    public function load_more(Request $request)
    {

        $page = $request->input('page');

        $per_page = 20;

        $medias = Media::skip($per_page * ($page - 1))->take($per_page)->orderBy('id', 'desc')->get();

        $count_media = Media::count();

        return response()->json([
            'status' => true,
            'message' => 'Success!',
            'medias' => $medias,
            'count_media' => $count_media,
        ], 200);
    }

    public function detail(Request $request)
    {

        $media_id = $request->input('media_id');

        $media = Media::with(['user'])->where('id', $media_id)->first();

        return response()->json([
            'status' => true,
            'message' => 'Success!',
            'media' => $media,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $media = Media::where('id', $id)->first();

        if ($media) {

            $media_id = $request->input('media_id');
            $media_title = $request->input('title');
            $media_slug = $request->input('slug');
            $media_caption = $request->input('caption');

            $data_update = [];

            $data_update['title'] = $media_title;
            $data_update['slug'] = $media_slug ? Str::slug($media_slug) : Str::slug($media_title);
            $data_update['excerpt'] = $media_caption;
            $data_update['updated_at'] = now();

            $update = Media::where('id', $media_id)->update($data_update);

            if ($update) {
                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                ], 200);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        $media = Media::where('id', $id)->first();

        if ($media) {

            DB::beginTransaction();

            try {

                $media_id = $request->input('media_id');

                $filePath = 'uploads/' . $media->filename;

                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }

                Media::where('id', $media_id)->delete();

                $count_media = Media::count();

                DB::commit();

                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                    'count_media' => $count_media,
                ], 200);

            } catch (\Exception $e) {

                DB::rollBack();

                Log::error($e->getMessage());

                return response()->json([
                    'status' => false,
                    'message' => 'Failed!',
                ], 500);
            }
        }else{

            return response()->json([
                'status' => false,
                'message' => 'Media tidak ditemukan.',
            ], 404);

        }
    }
}
