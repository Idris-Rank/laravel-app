@extends('admin.template.master')

@section('title', 'Dashboard')

@section('content')

    {{-- <div class="relative z-50" id="modal-detail-media">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="fixed inset-0 z-10">
            <div class="max-w-4xl mx-auto h-screen p-6">
                <div class="bg-white w-full h-full flex flex-col p-6 gap-4 rounded-lg justify-betwwen">

                    <div class="flex gap-2 items-center justify-between">
                        <h3 class="text-base font-semibold text-center leading-6 text-gray-900" id="modal-title">
                            Detail media</h3>
                        <div>
                            <span
                                class="btn-close-media-detail hover:bg-indigo-700 cursor-pointer block rounded-full bg-indigo-600 text-white p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12">
                                    </path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="h-full w-full gap-4 overflow-y-auto sm:overflow-hidden">

                        <div class="flex h-full gap-6">
                            <div class="w-2/3">
                                <img class="h-full w-full rounded-md object-contain bg-gray-100"
                                    src="http://127.0.0.1:8000/storage/uploads/pain-tendo.jpg" class="w-full object-cover"
                                    alt="Pain Tendo">
                            </div>
                            <div class="w-1/3 flex flex-col h-full justify-between">
                                <input type="hidden" name="media_id" id="media_id" value="24">
                                <div class="space-y-2">
                                    <div>
                                        <label for="title"
                                            class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                        <input type="text" name="title" id="title" value=""
                                            placeholder="Enter title"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div>
                                        <label for="slug"
                                            class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                        <input type="text" name="slug" id="slug" disabled=""
                                            placeholder="Enter slug" value=""
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div>
                                        <label for="caption"
                                            class="block text-sm font-medium leading-6 text-gray-900">Caption</label>
                                        <input type="text" name="caption" id="caption" value=""
                                            placeholder="Enter caption"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>

                                    <div>
                                        <label for="url"
                                            class="block text-sm font-medium leading-6 text-gray-900">Url</label>
                                        <input type="text" name="url" id="url" disabled=""
                                            placeholder="Enter url" value=""
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                    <div class="text-xs">
                                        <ul>
                                            <li>Upload by: <span class="upload-by">Idris Efendi</span></li>
                                            <li>Upload at: <span class="upload-at">2025-05-23T15:58:46.000000Z</span>
                                            </li>
                                            <li>Type: <span class="type">image/jpeg</span></li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="flex items-center w-full gap-2">
                                    <button type="button"
                                        class="btn-delete-media inline-flex w-full justify-center rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-400"><span>Delete</span></button>
                                    <button type="button"
                                        class="btn-update-media inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500"><span>Update</span></button>
                                    <button type="button"
                                        class="btn-set-media inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm text-nowrap hover:bg-green-500"><span>Set
                                            Media</span></button>
                                </div>
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div>
        <h1>Ini halaman dashboard</h1>
    </div>

@section('script')
@endsection

@endsection
