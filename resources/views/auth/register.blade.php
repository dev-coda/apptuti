@extends('layouts.page')


@section('content')
<div class="flex flex-col  mx-auto pt:mt-0 ">
    <div class="w-full max-w-4xl ">
        <h1 class='text-xl font-bold mb-10'>Registro</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->

            <div class='grid grid-cols-2 gap-5'>
                {{ Aire::input('first_name', 'Nombre')->groupClass('mb-0') }}
                {{ Aire::input('last_name', 'Apellidos')->groupClass('mb-0') }}
                

                {{ Aire::input('document', 'Documento')->groupClass('mb-0') }}
                {{ Aire::select(['Cédula de ciudadanía', 'NIT'], 'city_id', 'Tipo de documento')->value(1)->groupClass('mb-0') }}


                {{ Aire::input('company', 'Nombre de la empresa')->groupClass('mb-0') }}
                {{ Aire::input('correo', 'Correo electronico')->groupClass('mb-0') }}

                {{ Aire::select($states, 'state_id', 'Departamento')->value(1)->id('states')->groupClass('mb-0') }}
                {{ Aire::select($cities, 'city_id', 'Ciudad')->value(1)->id('cities')->groupClass('mb-0') }}

                {{ Aire::input('address', 'Dirección')->groupClass('mb-0') }}
                {{ Aire::input('area', 'Barrio')->groupClass('mb-0') }}

                {{ Aire::input('phone', 'Teléfono')->groupClass('mb-0') }}
                {{ Aire::input('mobile', 'Celular')->groupClass('mb-0') }}


                {{ Aire::password('password', 'Contraseña')->groupClass('mb-0') }}
                {{ Aire::password('password_confirmation', 'Confirme Contraseña')->groupClass('mb-0') }}
            </div>

            
        

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
@endsection


@section('scripts')
    
<script>
    $(function(){
        $('#states').change(function(){
            const state = $(this).val()
            
            const url = `{{ route('cities.index') }}?state=${state}`

            axios.get(url).then(function(response){
                console.log(response.data)
                const cities = response.data

                $('#cities').empty()

                cities.forEach(city => {
                    $('#cities').append(`<option value="${city.id}">${city.name}</option>`)
                });

            })

        })
    })
</script>

@endsection