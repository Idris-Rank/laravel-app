@extends('admin.template.master')

@section('title', 'Edit Post')

@section('wysiwyg-editor-style')

    @include('admin.template.components.wysiwyg-style')

@endsection

@section('media')

    @include('admin.template.components.media')

@endsection

@php
    $post_id = $post->id;
    $title = $post->title;
    $slug = $post->slug;
    $content = $post->content;
    $status = $post->status;
    $type = $post->type;
    $image_id = $post->image_id;
    $created_at = $post->created_at ? date('Y-m-d H:i:s', strtotime($post->created_at)) : '-';
    $updated_at = $post->updated_at ? date('Y-m-d H:i:s', strtotime($post->updated_at)) : '-';
    $user_id = $post->user_id;
    $user_editor_id = $post->user_editor_id;

@endphp

@section('content')

    <div class="space-y-4">
        <div class="flex gap-4 items-center">
            <h1 class="text-2xl font-medium">Edit post</h1>
            <div
                class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                <a href="{{ route('admin-post-create') }}"
                    class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                    Add Post
                </a>
            </div>
        </div>

        @include('admin.template.components.alert')

        <form action="{{ route('admin-post-update', ['id' => $post_id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-12">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-8">
                        <div class="grid grid-cols-12 gap-x-6 gap-y-2">
                            <div class="col-span-12">
                                <label for="title"
                                    class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-1">
                                    <input type="text" name="title" id="title" autocomplete="off"
                                        value="{{ old('title') ?? $title }}" placeholder="Enter title"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @error('title')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-span-12">
                                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-1">
                                    <input type="text" name="slug" id="slug" autocomplete="off"
                                        value="{{ old('slug') ?? $slug }}" placeholder="Enter slug"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @error('slug')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-span-12">
                                <label for="content"
                                    class="block text-sm font-medium leading-6 text-gray-900">Content</label>
                                <div class="mt-1">
                                    <textarea name="content" id="content" rows="4"
                                        class="wysiwyg-editor block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('content') ?? $content }}</textarea>
                                    @error('content')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-span-6">
                                <label for="user" class="block text-sm font-medium leading-6 text-gray-900">User</label>
                                <div class="mt-1">
                                    <select name="user" id="user"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        @foreach ($users as $k_user => $v_user)
                                            <option value="{{ $v_user->id }}"
                                                {{ (int) $user_id === (int) $v_user->id ? 'selected' : '' }}>
                                                {{ $v_user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-span-6">
                                <label for="user-editor" class="block text-sm font-medium leading-6 text-gray-900">User
                                    editor</label>
                                <div class="mt-1">
                                    <select name="user_editor" id="user-editor"
                                        class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        @foreach ($users as $k_user => $v_user)
                                            <option value="{{ $v_user->id }}"
                                                {{ (int) $user_editor_id === (int) $v_user->id ? 'selected' : '' }}>
                                                {{ $v_user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_editor')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-4">
                        <div class="sticky top-20 space-y-4">
                            <div class="bg-white rounded-md shadow-sm border">
                                <div class=" border-b  p-4 ">
                                    <div class="text-lg font-bold">
                                        Action
                                    </div>
                                </div>

                                <div class="p-4 space-y-4">

                                    <div class="space-y-4">

                                        @if ($status == 2)
                                            <button type="submit" name="status" value="2"
                                                class="group h-10 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">

                                                <svg class="h-5 w-5 shrink-0 mr-1" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M48 96l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-245.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3L448 416c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32l245.5 0c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8L320 184c0 13.3-10.7 24-24 24l-192 0c-13.3 0-24-10.7-24-24L80 80 64 80c-8.8 0-16 7.2-16 16zm80-16l0 80 144 0 0-80L128 80zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z">
                                                    </path>
                                                </svg>
                                                <span
                                                    class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                                                    Save Draft
                                                </span>
                                            </button>
                                        @endif

                                        <div>
                                            <p class="text-sm text-c0-500">
                                                Detail informasi post
                                            </p>
                                            <ul class="list-disc text-sm text-c0-600 pl-6 mt-2">
                                                <li>
                                                    Status: <span>{{ post_status($status) }}</span>
                                                </li>
                                                <li>
                                                    Di publish pada: <span class="font-semibold">{{ $created_at }}</span>
                                                </li>
                                                <li>
                                                    Terakhir diedit pada: <span
                                                        class="font-semibold">{{ $updated_at }}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="flex gap-2 items-center justify-between w-full">
                                            <button type="submit" name="3"
                                                class="group h-10 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-white bg-red-500 border border-red-600 hover:border-red-400 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">

                                                <svg class="h-5 w-5 shrink-0 mr-1" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                                <span
                                                    class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                                                    Trash
                                                </span>
                                            </button>
                                            <button type="submit" name="status" value="1"
                                                class="group h-10 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-white bg-indigo-500 border border-indigo-600 hover:border-indigo-400 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">

                                                <svg class="h-5 w-5 shrink-0 mr-1" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M48 96l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-245.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3L448 416c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32l245.5 0c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8L320 184c0 13.3-10.7 24-24 24l-192 0c-13.3 0-24-10.7-24-24L80 80 64 80c-8.8 0-16 7.2-16 16zm80-16l0 80 144 0 0-80L128 80zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z">
                                                    </path>
                                                </svg>
                                                <span
                                                    class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                                                    {{ $status == 1 ? 'Save' : 'Publish' }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-md shadow-sm border">
                                <div class="border-b p-4">
                                    <div class="text-lg font-bold">
                                        Featured image
                                    </div>
                                </div>

                                <div class="p-4 space-y-1">
                                    <div class="media box-image col-span-12 lg:col-span-3 space-y-1">
                                        <div class="w-full h-full">
                                            <div
                                                class="btn-open-media {{ $image_id ? 'hidden' : '' }} relative group cursor-pointer duration-300 bg-gray-100 hover:bg-gray-200 rounded-md w-full h-full flex items-center justify-center max-h-40">
                                                <div class="flex flex-col items-center justify-center py-8">
                                                    <div>
                                                        <svg class="text-gray-400 h-10 w-10" fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path class="fa-secondary" opacity=".4"
                                                                d="M0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L288 96c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32L64 32C28.7 32 0 60.7 0 96zM160 272c0-6.1 2.3-12.3 7-17l72-72c4.7-4.7 10.8-7 17-7s12.3 2.3 17 7l72 72c4.7 4.7 7 10.8 7 17s-2.3 12.3-7 17c-9.4 9.4-24.6 9.4-33.9 0l-31-31L280 360c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-102.1-31 31c-9.4 9.4-24.6 9.4-33.9 0c-4.7-4.7-7-10.8-7-17z">
                                                            </path>
                                                            <path class="fa-primary"
                                                                d="M256 384c13.3 0 24-10.7 24-24l0-102.1 31 31c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-72-72c-9.4-9.4-24.6-9.4-33.9 0l-72 72c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l31-31L232 360c0 13.3 10.7 24 24 24z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div
                                                        class="text-center text-sm font-semibold text-gray-500 group-hover:text-gray-700 duration-300">
                                                        Upload media
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($image_id)
                                                @php
                                                    $image_url = $post->media->guid;
                                                @endphp

                                                <div class="image">
                                                    <div class="w-full h-64 rounded-md overflow-hidden">
                                                        <img src="{{ $image_url }}"
                                                            class="h-full w-full object-cover">
                                                        <input type="hidden" name="image"
                                                            value="{{ $image_id }}">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="image hidden">
                                                    <div class="w-full h-64 rounded-md overflow-hidden">
                                                        <img src="" class="h-full w-full object-cover">
                                                        <input type="hidden" name="image" value="0">
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                        <div
                                            class="btn-remove-image {{ $image_id ? '' : 'hidden' }} cursor-pointer hover:text-indigo-600 text-sm underline text-indigo-500">
                                            Remove image</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('wysiwyg-editor-script')

    @include('admin.template.components.wysiwyg-script')

@endsection

@section('script')
@endsection
