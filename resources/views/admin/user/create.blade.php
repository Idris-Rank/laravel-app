@extends('admin.template.master')

@section('title', 'Create User')

@section('media')

@include('admin.template.components.media')

@endsection

@section('content')

    <div class="space-y-4">
        <div class="flex gap-4 items-center">
            <h1 class="text-2xl font-medium">Create user</h1>
        </div>

        @include('admin.template.components.alert')

        <form action="{{ route('admin-user-store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-8">
                        <div class="grid grid-cols-12 gap-x-6 gap-y-2">
                            <div class="col-span-6">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" autocomplete="given-name"
                                        value="{{ old('name') ?? '' }}" placeholder="Admin"
                                        class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @error('name')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-span-6">
                                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-1">
                                    <input type="text" name="slug" id="slug" value="{{ old('slug') ?? '' }}"
                                        placeholder="admin"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @error('slug')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="email"
                                    class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                <div class="mt-1">
                                    <input type="text" name="email" id="email" value="{{ old('email') ?? '' }}"
                                        placeholder="example@gmail.com"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @error('email')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Role</label>
                                <div class="mt-1">

                                    <select name="role" id="role"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        @foreach ($roles as $k_role => $v_role)
                                            <option value="{{ $v_role->id }}"
                                                {{ old('role') == $v_role->id ? 'selected' : '' }}>{{ $v_role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('role')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                                <div class="mt-1">
                                    <div class="relative">
                                        <input type="password" name="password" id="password" placeholder="*****"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-c1-600 sm:text-sm sm:leading-6">
                                        <span
                                            class="btn-toggle-password absolute top-0 right-0 text-gray-800 flex h-full items-center px-2 cursor-pointer hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('password')
                                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label for="conform-password" class="block text-sm/6 font-medium text-gray-900">Confirm
                                    Password</label>
                                <div class="mt-1">
                                    <div class="relative">
                                        <input type="password" name="confirm_password" id="confirm-password"
                                            placeholder="*****"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-c1-600 sm:text-sm sm:leading-6">
                                        <span
                                            class="btn-toggle-password absolute top-0 right-0 text-gray-800 flex h-full items-center px-2 cursor-pointer hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </span>
                                    </div>
                                    @error('confirm_password')
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

                                <div class="p-4 space-y-4 flex justify-end">
                                    <button type="submit"
                                        class="btn-save group h-10 w-auto shrink-0 rounded font-semibold px-3 py-2 cursor-pointer text-white bg-indigo-500 border border-indigo-600 hover:border-indigo-400 shadow-sm hover:shadow-base transition duration-300 inline-flex gap-x-1 justify-between items-center">

                                        <svg class="h-5 w-6 shrink-0 mr-1" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M48 96l0 320c0 8.8 7.2 16 16 16l320 0c8.8 0 16-7.2 16-16l0-245.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3L448 416c0 35.3-28.7 64-64 64L64 480c-35.3 0-64-28.7-64-64L0 96C0 60.7 28.7 32 64 32l245.5 0c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8L320 184c0 13.3-10.7 24-24 24l-192 0c-13.3 0-24-10.7-24-24L80 80 64 80c-8.8 0-16 7.2-16 16zm80-16l0 80 144 0 0-80L128 80zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z">
                                            </path>
                                        </svg>
                                        <span class="whitespace-nowrap text-xs sm:text-sm font-medium tracking-normal">
                                            Save
                                        </span>
                                    </button>
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
                                                class="btn-open-media relative group cursor-pointer duration-300 bg-gray-100 hover:bg-gray-200 rounded-md w-full h-full flex items-center justify-center max-h-40">
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

                                            <div class="image hidden">
                                                <div class="w-full h-full rounded-md overflow-hidden">
                                                    <img src="" class="h-full w-full object-cover">
                                                    <input type="hidden" name="image" value="0">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div
                                            class="btn-remove-image hidden cursor-pointer hover:text-indigo-600 text-sm underline text-indigo-500">
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

@section('script')
@endsection
