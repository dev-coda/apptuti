<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/site.js'])


    @yield('head')
</head>



<body class="antialdiased font-dm text-primary" >

    @include('elements.mobile-menu')


    @php
        $categories  = App\Models\Category::active()->whereNull('parent_id')->with('children')->orderBy('name')->get();
    @endphp
    <div class="bg-orange-500 py-2">
        <div class="container mx-auto">
            <div class="flex justify-center  space-x-5 text-white">
                <span>tuti@tuti.com.co</span>
                <span>3104450101</span>
            </div>
        </div>
    </div>
    <nav class="bg-white border-gray-200 border-b  ">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-1 px-4">

            <button id='openMobileMenu' class="text-orange-500 flex xl:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>    
            </button>
            <div class="flex items-center space-x-4">
                {{-- <a href="" class="text-orange-500 hidden xl:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>    
                </a> --}}
                <a href="{{route('home')}}" class="flex items-center">
                    <img src="{{ public_asset('img/tuti.png') }}" class="h-14 mr-3" alt="Flowbite Logo" />
                </a>
                {{-- <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-multi-level" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button> --}}
            </div>
           
            <div class="xl:flex hidden items-center space-x-10">

                <form action="" class="relative">
                    <input placeholder="Busqueda" type="text" class='bg-[#e8e7e5] border-0 rounded w-96'>
                    <svg class=" absolute right-2 top-2 text-gray-500 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                      
                </form>
              

                {{-- <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
                    <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="{{ route('home') }}" class="block py-2 pl-3 pr-4 text-gray-700 bg-blue-700 rounded md:bg-transparent md:p-0 " aria-current="page">Home</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 pl-3 pr-4  text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto ">Productos <svg class="w-5 h-5 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                @foreach ($categories as $category)
                                    @if ($category->children->count())
    
                                    <li aria-labelledby="dropdownNavbarLink{{ $category->id }}">
                                        <a href="{{ route('category', $category->slug) }}" id="doubleDropdownButton{{ $category->id }}" data-dropdown-toggle="doubleDropdown{{ $category->id }}" data-dropdown-placement="right-start" data-dropdown-trigger="hover"  type="button" class="flex items-center justify-between w-full px-4 py-2">{{ $category->name }}<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></a>
                                        <div id="doubleDropdown{{ $category->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="doubleDropdownButton{{ $category->id }}">
                                                @foreach ($category->children as $c)
                                                    <li>
                                                        <a href="{{ route('category2', [$category->slug, $c->slug]) }}" class="block px-4 py-2 hover:bg-gray-100">
                                                            {{ $c->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                    
                                    @else
    
                                    <li>  
                                        <a href="{{ route('category', $category->slug) }}" class="block px-4 py-2 hover:bg-gray-100">{{ $category->name }}</a>
                                    </li>
                                    @endif
                                
                                    
                                @endforeach
                            
                            </ul>
                    
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('brands') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 ">Proveedores</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
                    </li>
                    @role('admin')
                        <li>
                            <a href="{{ route('dashboard') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Admin</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Ingresar</a>
                        </li>
                    @endrole
    
                    <li>
                        @php
                            $cart = session()->get('cart');
                        @endphp
    
                        @if($cart)
                            <a href="{{ route('cart') }}" class='flex space-x-2'>
                                <span>{{ count($cart) }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>                      
                            </a>
                        @endif
                    </li>
                    </ul>
    
                    
                </div> --}}
            </div>

            <div class="justify-end space-x-2 xl:flex hidden">
                <a class="bg-gray3 py-1 px-2 text-gray-700" href="{{route('cart')}}">Carrito</a>
                <a class="bg-gray3 py-1 px-2 text-gray-700" href="#">Acceder</a>
                <a class="bg-gray3 py-1 px-2 text-gray-700"  href="#">Registrarme</a>
            </div>

            <div class="justify-end space-x-2 xl:hidden flex">
                <a class=" py-1 px-2 text-orange-500" href="#">Acceder</a>
            </div>
        </div>
    </nav>


  
    


        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <x-alert />
            @yield('content')
        </div>

        <section class="bg-gray4 py-10 mt-10">
            <div class="container mx-auto max-w-screen-xl" >
             
                <div class="w-full flex justify-center flex-col items-center text-gray-500">
                    <p>Banner invitando a registrarse</p>
                    <p>O hablando del proceso de pedido</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20 ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                
              
            </div>
        </section>
        

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
        <script>
            $('#closeMobileMenu').click(function(){
                $('#mobileMenu').hide();
            });

            $('#openMobileMenu').click(function(){
                $('#mobileMenu').show();
            });
        </script>

        @yield('scripts')
    </body>


</html>
