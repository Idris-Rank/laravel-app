@extends('admin.template.master')

@section('title', 'Media')

@section('media')

@include('admin.template.components.media')

@endsection

@section('content')

    <div class="space-y-4">
        <div>
            <div class="flex gap-4 items-center">
                <h1 class="text-2xl font-medium">Media</h1>
                <div
                    class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                    <button class="btn-open-upload-media whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                        Add Media
                    </button>
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
                        <div class="btn-detail-media border cursor-pointer rounded-lg overflow-hidden">
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

@endsection
