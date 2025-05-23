<head>
    <meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - ADMIN</title>

	<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

	@yield('wysiwyg-editor-style')

	<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> 
	<script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
	<script>    
		tailwind.config = {
			darkMode: 'class',
			theme: {
				display: ["group-hover"],
				screens: {
					'xs': '400px',
					'sm': '640px',
					'md': '768px',
					'lg': '1024px',
					'xl': '1280px',
					'2xl': '1536px',
				},
				extend: {
					fontFamily: {
						sans: [
							'Archivo',
						],
					},
				},
				boxShadow: {
					'sm': '0 1px 2px 0 rgb(0 0 0 / 0.05)',
					'base': '0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)',
					'md': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
					'lg': '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)',
					'xl': '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)',
					'2xl': '0 25px 50px -12px rgb(0 0 0 / 0.25)',
					'inner': 'inset 0 2px 4px 0 rgb(0 0 0 / 0.05)',
					'none': '0 0 #0000',
					'solid-xs': '2.5px 3px',
					'solid-sm': '5px 5px',
					'solid-md': '7.5px 7.5px',
					'solid-lg': '10px 10px',
				},
				fontSize: {
					'xxs': '.7rem',
					'xs': '.75rem',
					'sm': '.875rem',
					'base': '.950rem',
					'md': '1rem',
					'lg': '1.125rem',
					'xl': '1.25rem',
					'2xl': '1.5rem',
					'3xl': '1.875rem',
					'4xl': '2.25rem',
					'5xl': '3rem',
					'6xl': '4rem',
					'7xl': '5rem',
				},
			},
		}
	</script>
</head>