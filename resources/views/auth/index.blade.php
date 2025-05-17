@extends('auth.template.master')

@section('title', 'Signin')

@section('content')

<main>
	<div class="flex h-screen flex-col justify-center px-6 py-12 lg:px-8">
		<div class="sm:mx-auto sm:w-full sm:max-w-sm">
			<h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
		</div>

		<div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">

			@if ($errors->has('error'))

			<div class="rounded-md bg-red-50 p-4 mt-4 content-alert">
				<div class="flex">
					<div class="flex-shrink-0">
						<svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
						</svg>
					</div>
					<div class="ml-3">
						<p class="text-sm font-medium text-red-800">{{ $errors->first('error') }}</p>
					</div>
					<div class="ml-auto pl-3">
						<div class="-mx-1.5 -my-1.5">
							<button type="button" class="btn-close-alert inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
								<span class="sr-only">Dismiss</span>
								<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
								</svg>
							</button>
						</div>
					</div>
				</div>
			</div>

			@endif

			<form class="space-y-6" action="{{ route('auth-admin-login') }}" method="POST">
				@csrf
				<div>
					<label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
					<div class="mt-1">
						<input type="text" name="email" value="{{ old('email') ?? '' }}" id="email" autocomplete="off" placeholder="Enter email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-c1-600 sm:text-sm sm:leading-6">
						@error('email')
						<div class="mt-1 text-sm text-red-600">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div>
					<label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
					<div class="mt-1">
						<div class="relative">
							<input type="password" name="password" id="password" autocomplete="current-password" placeholder="*****" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-c1-600 sm:text-sm sm:leading-6">
							<span class="btn-toggle-password absolute top-0 right-0 text-gray-800 flex h-full items-center px-2 cursor-pointer hover:text-blue-500">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
									<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
								</svg>
							</span>
						</div>
						@error('password')
						<div class="mt-1 text-sm text-red-600">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div>
					<button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
				</div>
			</form>
		</div>
	</div>
</main>

@section('script')
<script>
	$(document).ready(function(){

		$('.btn-toggle-password').click(function(event) {

			let thisBtn = $(this);

			let type = thisBtn.parent().find('input').attr('type');

			if(type == 'password'){

				thisBtn.parent().find('input').attr('type', 'text');

				thisBtn.parent().find('span').empty().append(`
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
						  	<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
						</svg>
				`);

			}else{

				thisBtn.parent().find('input').attr('type', 'password');

				thisBtn.parent().find('span').empty().append(`
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						</svg>
				`);

			}

		});

	});
</script>
@endsection

@endsection