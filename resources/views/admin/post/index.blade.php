@extends('admin.template.master')

@section('title', 'Posts')

@section('content')

    <div class="space-y-4">
        <div>
            <div class="flex gap-4 items-center">
                <h1 class="text-2xl font-medium">Posts</h1>
                <div
                    class="group h-8 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-indigo-500 hover:text-indigo-900 border border-indigo-500 hover:border-indigo-900 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">
                    <a href="{{ route('admin-post-create') }}"
                        class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                        Add Post
                    </a>
                </div>
            </div>
        </div>

        @include('admin.template.components.alert')

        <div class="flow-root">
            <div class="flex justify-between mb-2">

                <div class="flex items-center gap-2 text-sm font-medium">
					<a href="{{ route('admin-post') }}?status=all" class="text-gray-700 hover:underline {{ request('status') == 'all' ? 'underline' : '' }}">All ({{ $posts_publish + $posts_draft + $posts_trash }})</a>
					<a href="{{ route('admin-post') }}?status=1" class="text-gray-700 hover:underline {{ request('status') == 1 ? 'underline' : '' }}">Publish ({{ $posts_publish }})</a>
					<a href="{{ route('admin-post') }}?status=2" class="text-gray-700 hover:underline {{ request('status') == 2 ? 'underline' : '' }}">Draft ({{ $posts_draft }})</a>
					<a href="{{ route('admin-post') }}?status=3" class="text-gray-700 hover:underline {{ request('status') == 3 ? 'underline' : '' }}">Trash ({{ $posts_trash }})</a>
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
            <div class="overflow-x-auto align-middle">
                <div class="overflow-y-auto shadow md:rounded-sm overflow-hidden">
                    <table class="min-w-full border border-c0-300">
                        <thead class="bg-indigo-600">
                            <tr>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">No.</th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block">Title</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block">Status</span></svg>
                                        </a>
                                    </div>
                                </th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block">Type</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block">User</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block whitespace-nowrap">Created at</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-2.5 py-2 text-left text-xs font-semibold text-white">
                                    <div class="flex gap-1.5 items-center">
                                        <span class="inline-block whitespace-nowrap">Updated at</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-3 py-2 text-left text-xs font-semibold text-white text-center">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php

                                $per_page = $posts->perPage();
                                $current_page = $posts->currentPage();

                                $no = $current_page * $per_page - $per_page;

                            @endphp
                            @foreach ($posts as $k_post => $v_post)
                                @php
                                    $no++;
                                    $post_id = $v_post->id;
                                    $title = $v_post->title;
                                    $status = post_status($v_post->status);
                                    $type = $v_post->type;
                                    $user = $v_post->user;
                                    $user_name = $user->name;
                                    $created_at = $v_post->created_at;
                                    $updated_at = $v_post->updated_at;
                                @endphp
                                <tr class="even:bg-gray-100 odd:bg-white">
                                    <td class="text-center px-2.5 py-2 text-xs text-c0-700">
                                        <div class="flex gap-2 items-center justify-center">
                                            <span class="no">{{ $no }}</span>
                                        </div>
                                    </td>
                                    <td class="px-2.5 py-2 text-xs text-c0-700 w-full">
                                        <span>{{ $title }}</span>
                                    </td>
                                    <td class="px-2.5 py-2 text-xs text-c0-700">
                                        <span>{{ $status }}</span>
                                    </td>
                                    
                                    <td class="px-2.5 py-2 text-xs text-c0-700 whitespace-nowrap text-center">
                                        <span>{{ $type }}</span>
                                    </td>
                                    <td class="px-2.5 py-2 text-xs text-c0-700 text-nowrap">
                                        <span>{{ $user_name }}</span>
                                    </td>
                                    <td class="px-2.5 py-2 text-xs text-c0-700 whitespace-nowrap">
                                        <span>{{ $created_at }}</span>
                                    </td>
                                    <td class="px-2.5 py-2 text-xs text-c0-700 whitespace-nowrap">
                                        <span>{{ $updated_at }}</span>
                                    </td>
                                    <td class="action px-2.5 py-2 text-xs text-c0-700 text-center">
                                        <div class="flex gap-1.5 items-center justify-center w-full">
                                            <a href="{{ route('admin-post-edit', ['id' => $post_id]) }}" title="Edit post"
                                                class="text-white inline-block px-1.5 py-1 rounded-sm bg-green-600 hover:bg-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
                                                    </path>
                                                </svg>
                                            </a>
                                            
                                            @if ($v_post->status == 3)

                                            <form class="flex items-center" method="POST"
                                                action="{{ route('admin-post-restore', ['id' => $post_id]) }}">
                                                @csrf
                                                <button type="submit" title="Restore"
                                                    class="text-white inline-block px-1.5
                                                    py-1 rounded-sm bg-orange-600 hover:bg-orange-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                    </svg>

                                                </button>
                                            </form>

                                            <form class="flex items-center" method="POST"
                                                action="{{ route('admin-post-destroy', ['id' => $post_id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Destroy"
                                                    class="text-white inline-block px-1.5
                                                    py-1 rounded-sm bg-red-600 hover:bg-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                </button>
                                            </form>

                                            @else
                                                <a href="{{ route('admin-post-trash', ['id' => $post_id]) }}" title="Trash"
                                                    class="text-white inline-block px-1.5 py-1 rounded-sm bg-orange-600 hover:bg-orange-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                            class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                </a>
                                            @endif
                                            
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="py-2">
                        {{ $posts->links('admin.template.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {



        });
    </script>
@endsection
