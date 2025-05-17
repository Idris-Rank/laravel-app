<!doctype html>
<html>
@include('auth.template.head')
<body>

	@yield('content')

	@include('auth.template.script')

	@yield('script')

</body>
</html>

