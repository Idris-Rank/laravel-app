<!DOCTYPE html>
<html lang="en">

@include('admin.template.head')

<body>
    <div>
        
        @include('admin.template.sidebar')

        <div class="lg:pl-72">
            
            @include('admin.template.navbar')

            <main class="py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    
                    @yield('content')

                </div>
            </main>
        </div>
    </div>

    @include('admin.template.script')

    @yield('script')

</body>

</html>
