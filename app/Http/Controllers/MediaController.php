<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];

        $data['medias'] = Media::orderBy('id', 'desc')->get();

        return view('admin.media.index', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'upload_media.*' => 'required|file|mimes:jpg,jpeg,png,webp'
        ]);

        $uploadedFiles = [];

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

            if($path){

                $data_store = [];
                $data_store['title'] = $filenameOnly;
                $data_store['slug'] = $slug;
                $data_store['excerpt'] = NULL;
                $data_store['guid'] = asset('storage/' . $directory . '/' . $finalName);
                $data_store['type'] = $file->getMimeType();
                $data_store['filename'] = $originalName;
                $data_store['user_id'] = Auth::user()->id;
                $data_store['created_at'] = now();
                $data_store['updated_at'] = now();

                $media = Media::create($data_store);

                if($media){

                    $data_store['id'] = $media->id;

                }

                $uploadedFiles[] = $data_store;

            }

        }

        return response()->json([
            'status' => true,
            'message' => 'File berhasil diupload!',
            'files' => $uploadedFiles
        ], 200);
    }
}
