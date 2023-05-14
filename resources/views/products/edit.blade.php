@extends('layouts.admin')

@section('head')
    <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
@endsection


@section('content')
{{ Aire::open()->route('products.update', $product)->bind($product)->enctype('multipart/form-data')}}
<div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 ">
    <div class="mb-4 col-span-full xl:mb-2">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Actualizar Producto</h1>
    </div>

    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Información</h3>

            <div class="grid grid-cols-6 gap-6">


                {{ Aire::input('name', "Nombre")->groupClass('col-span-3') }}
                {{ Aire::input('slug', "Slug")->groupClass('col-span-3') }}
                 {{ Aire::input('sku', "SKU")->groupClass('col-span-3') }}

                {{ Aire::input('price', "Precio")->groupClass('col-span-3') }}
                {{ Aire::input('delivery_days', "Tiempo de entrega")->helpText('Días')->groupClass('col-span-3') }}

                {{ Aire::input('quantity_min', "Cantidad mínima")->groupClass('col-span-3') }}
                {{ Aire::input('quantity_max', "Cantidad maxima")->helpText('Si esta en cero no hay límite')->groupClass('col-span-3') }}
                
                {{  Aire::range('discount', 'Descuento %')->id('discount')->value(old('discount', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')}}

                {{  Aire::range('step', 'Steps')->data('sufix', '')->id('step')->value(old('step', 0))->min(0)->max(100)->step(1)->groupClass('col-span-6')->helpText('Salto de cantidad para el precio')}}
              

                {{ Aire::textarea('description', "Descripción")->id('description')->rows(5)->groupClass('col-span-6') }}
                {{ Aire::textarea('short_description', "Descripción corta")->id('sort_description')->rows(5)->groupClass('col-span-6') }}



               <div>
                {{ Aire::hidden('active')->value(0)}}
                <label class="relative inline-flex items-center cursor-pointer">
                    <input @checked($product->active) type="checkbox" name='active' value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all0 peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-medium text-gray-900 ">Activo</span>
                </label>
  
            
               </div>

                <div class="col-span-6 justify-between  items-center mt-5 space-x-2 flex">

                    <p class="flex space-x-2 items-center">
                        {{ Aire::submit('Actualizar')->variant()->submit() }}
                        <a href="{{ route('products.index') }}">Cancelar</a>
                    </p>


                    
                    <button type="button" id="deleteProductButton"
                    data-drawer-target="drawer-delete-product-default"
                    data-drawer-show="drawer-delete-product-default"
                    aria-controls="drawer-delete-product-default" data-drawer-placement="right"
                    class="flex items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 text-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Eliminar producto</span>
                    </button>
                   
                </div>
            </div>


        </div>
    </div>

    <div class="col-span-1">
      
        <x-product-attributes  
            relation='brands'
            :product="$product"
            :items="$brands"
            title="Marcas" 
        />


        <x-product-attributes  
            relation='categories'
            :product="$product"
            :items="$categories"
            title="Categorías" 
        />
        
        {{-- <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Categorías</h3>
            <div class="grid grid-cols-2 gap-3">
                @foreach ($categories as $category) 
                    <div class="flex items-center cursor-pointer">
                        <input  @checked($product->categories->contains($category->id))
                            id="categories{{ $category->id }}" name="categories[]" type="checkbox" value="{{ $category->id }}"
                            @class([
                                'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-0 cursor-pointer ', 'opacity-50' => !$category->active])
                            >
                            <label  data-tooltip-target="tooltip-default{{ $category->id }}" for="categories{{ $category->id }}"  @class([
                                'ml-2 text-sm font-medium  cursor-pointer',
                                'text-gray-900' => $category->active,
                                'text-gray-400' => !$category->active
                                ])>{{ $category->name }}</label>
                            @if (!$category->active)
                            <div id="tooltip-default{{ $category->id }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Categoría desactivada
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            @endif
                           
                    </div>
                @endforeach
            </div>
        </div> --}}

        


        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <h3 class="mb-4 text-xl font-semibold ">Impuesto</h3>
            <div class="grid grid-cols-1 gap-3">
                {{Aire::select($taxes, 'tax_id')}}
            </div>
        </div>


        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            <p class="flex space-x-2 justify-between items-center">
                {{ Aire::submit('Actualizar')->variant()->submit() }}

                <button type="button" id="deleteProductButton"
                    data-drawer-target="drawer-delete-product-default"
                    data-drawer-show="drawer-delete-product-default"
                    aria-controls="drawer-delete-product-default" data-drawer-placement="right"
                    class="flex items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm px-5 py-2.5 text-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span>Eliminar producto</span>
                    </button>
            </p>
        </div>
        


    </div>

   
</div>
{{ Aire::close() }}



<div id="drawer-delete-product-default"
    class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white"
    tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
    <h5 id="drawer-label"
        class="inline-flex items-center text-sm font-bold text-gray-500 uppercase ">Eliminar Producto
    </h5>
    <button type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <svg class="w-10 h-10 mt-8 mb-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="mb-6 text-lg text-gray-500 ">¿Está seguro de que desea eliminar este producto?</h3>
  
    <div class="flex">
        {{ Aire::open()->route('products.destroy', $product) }}
            {{ Aire::button('Si, estoy seguro')->variant()->red() }}
        {{ Aire::close() }}


        <button href="#"
            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-sm px-3 py-2.5 text-center "
            type="button" data-drawer-dismiss="drawer-delete-product-default"
        aria-controls="drawer-delete-product-default">
            No, cancelar
        </button>

    </div>
    
</div>



@endsection



@section('scripts')
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  	
<script>
new FroalaEditor('#description', {
    height: 200
});		

new FroalaEditor('#sort_description', {
    height: 200
});		
</script>	
@endsection