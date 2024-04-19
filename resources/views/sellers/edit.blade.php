@extends('layouts.admin')


@section('content')

<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">{{$user->name}}</h1>
    </div>



    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>
            {{ Aire::open()->route('sellers.update', $user)->bind($user)}}
                
                <div class="grid grid-cols-2 gap-5">

                    {{ Aire::input('name', 'Nombre')->groupClass('mb-0') }}
                    {{ Aire::email('email', 'Correo electrónico')->groupClass('mb-0') }}

                    {{ Aire::number('zone', 'Zona')->groupClass('mb-0') }}
                    <div></div>

                    {{ Aire::password('password', 'Contraseña')->groupClass('mb-5')->value('') }}
                    {{ Aire::password('password_confirmation', 'Confirme Contraseña')->groupClass('mb-5') }}
                    
                </div>

                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">

                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Actualizar')->variant()->submit() }}
                        <a href="{{ route('sellers.index') }}">Cancelar</a>
                    </p>               
                </div>
            {{ Aire::close() }}
        </div>
    </div>

   

   
</div>



@endsection


