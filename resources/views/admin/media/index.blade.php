@extends('admin.template.master')

@section('title', 'Media')

@section('content')

    <div class="space-y-4">
        <div>
            <div class="flex gap-4 items-center">
                <h1 class="text-2xl font-medium">Media</h1>
                <div
                    class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                    <button class="btn-open-media-upload whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                        Add Media
                    </button>
                </div>
            </div>
        </div>


        <div class="relative z-50 hidden" id="modal-media-upload">
            <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative space-y-4 transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:py-6 sm:px-8">
                        <div class="space-y-3">
                            <div class="text-center space-y-4">
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Upload Media</h3>
                                <div class="border-2 border-gray-300 border-dashed rounded-lg py-4 space-y-4">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="input-media"
                                            class="flex flex-col items-center justify-center w-full cursor-pointer dark:hover:bg-gray-800 dark:bg-gray-700 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                        class="font-semibold">Click to
                                                        upload</span> or drag and drop</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                    (MAX. 800x400px)</p>
                                            </div>
                                            <input id="input-media" name="input_media[]" type="file" multiple
                                                class="hidden" />
                                        </label>

                                    </div>
                                    <div id="preview-media" class="hidden flex gap-2 items-center flex-wrap justify-center">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                            <button type="button"
                                class="btn-upload-media inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Upload</button>
                            <button type="button"
                                class="btn-cancel-media-upload mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="relative z-50 hidden" id="modal-media-detail">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div class="fixed inset-0 z-10">
                <div class="max-w-4xl mx-auto h-screen p-6">
                    <div class="bg-white w-full h-full p-6 rounded-lg">
                        <div class="h-full flex flex-col gap-4 justify-between">

                            <div class="flex gap-2 items-center justify-between">
                                <h3 class="text-base font-semibold text-center leading-6 text-gray-900" id="modal-title">
                                    Detail media</h3>
                                <div>
                                    <span
                                        class="btn-close-media-detail hover:bg-indigo-700 cursor-pointer block rounded-full bg-indigo-600 text-white p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12">
                                            </path>
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="h-full sm:flex w-full gap-4 overflow-y-auto sm:overflow-hidden">
                                <div class="grid grid-cols-12 gap-4 w-full">
                                    <div class="col-span-8">
                                        <img src=""
                                            class="object-cover rounded-md transition duration-300 ease-in-out group-hover:scale-110 w-full h-full"
                                            alt="">
                                    </div>
                                    <div class="col-span-4">
                                        <div class="grid content-between h-full">
                                            <input type="hidden" name="media_id" id="media_id" value="">
                                            <div class="space-y-2">
                                                <div>
                                                    <label for="title"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                                    <input type="text" name="title" id="title" value="" placeholder="Enter title"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                                <div>
                                                    <label for="slug"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                                    <input type="text" name="slug" id="slug" disabled="" placeholder="Enter slug"
                                                        value=""
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                                <div>
                                                    <label for="caption"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Caption</label>
                                                    <input type="text" name="caption" id="caption" value="" placeholder="Enter caption"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>

                                                <div>
                                                    <label for="url"
                                                        class="block text-sm font-medium leading-6 text-gray-900">Url</label>
                                                    <input type="text" name="url" id="url" disabled="" placeholder="Enter url"
                                                        value=""
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                                <div class="text-xs">
                                                    <ul>
                                                        <li>Upload by: <span class="upload-by"></span></li>
                                                        <li>Upload at: <span class="upload-at"></span></li>
                                                        <li>Type: <span class="type"></span></li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <button type="button"
                                                    class="btn-media-delete inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400  sm:w-auto"><span>Delete</span></button>
                                                <button type="button"
                                                    class="btn-media-update inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500  sm:w-auto"><span>Update</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>








        <div class="space-y-6">
            <div class="flex items-center w-full justify-between">
                <div>
                    <select id="media-type" name="media_type"
                        class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option>All media items</option>
                    </select>
                </div>
                <form method="GET">
                    <div class="flex gap-4 items-center">
                        <div>
                            <input type="search" name="s" value="{{ request('s') ?? '' }}" autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                        </div>

                        <button
                            class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                            <span class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">Search</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="media-list grid grid-cols-12 gap-4">
                @foreach ($medias as $k_media => $v_media)
                    @php
                        $media_id = $v_media->id;
                        $guid = $v_media->guid;
                        $title = $v_media->title;
                    @endphp
                    <div class="media col-span-2">
                        <div class="btn-media-detail border cursor-pointer rounded-lg overflow-hidden">
                            <img data-media-id="{{ $media_id }}" class="object-cover w-full h-36"
                                src="{{ $guid }}" alt="{{ $title }}">
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-center">
                <div class="space-y-2">
                    <div>
                        <p class="text-sm">Showing <span class="showing">{{ $medias->count() }}</span> of <span
                                class="count-media">{{ $count_media }}</span> media items</p>
                    </div>
                    <div class="flex items-center gap-2 justify-center">
                        <button type="button" data-page="2"
                            class="btn-load-more-media inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <span class="">Load more</span>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        let urlMediaStore = "{{ substr_replace(base64_encode(route('admin-media-store')), csrf_token(), 2, 0) }}";
        let urlMediaLoadMore = "{{ substr_replace(base64_encode(route('admin-media-load-more')), csrf_token(), 2, 0) }}";
        let urlMediaDetail = "{{ substr_replace(base64_encode(route('admin-media-detail')), csrf_token(), 2, 0) }}";
        let urlMediaUpdate = "{{ substr_replace(base64_encode(route('admin-media-update')), csrf_token(), 2, 0) }}";
        let urlMediaDestroy = "{{ substr_replace(base64_encode(route('admin-media-destroy')), csrf_token(), 2, 0) }}";
    </script>

@endsection
