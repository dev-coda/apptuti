
    
  
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 ">
            


            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Variaciones - {{ $product->variation->name }}</h1>

            <div class="relative overflow-x-auto mt-5">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3"></th>
                            <th scope="col" class="px-4 py-3">Nombre</th>
                            <th scope="col" class="px-4 py-3 ">Precio</th>
                            <th scope="col" class="px-4 py-3">SKU</th>
                            <th scope="col" class="px-4 py-3">Imagen</th>
                            
                
                            <th scope="col" class="px-4 py-3">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->items as $item)
                        <tr class="border-b">
                            <td class="w-4 px-4 py-3 ">
                                <div class="flex items-center">
                                    {{ Aire::hidden("variations[".$item->pivot->variation_item_id."][enabled]")->value(0)}}
                                    <input
                                        @checked($item->pivot->enabled) name='{{ "variations[".$item->pivot->variation_item_id."][enabled]" }}' type="checkbox" value='1'  class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="px-4 py-3 font-medium text-gray-900">
                                {{ $item->name }}   
                            </td>

                          
                            <td class="px-4 py-3 max-w-[5rem]">
                                {{ Aire::input("variations[".$item->pivot->variation_item_id."][price]")
                                    ->value(old("variations[".$item->pivot->variation_item_id."][price]", $item->pivot->price))
                                    ->groupClass('mb-0')
                                }}
                            </td>

                               <td class="px-4 py-3 max-w-[5rem]">
                                <div class="flex items-center">

                                    {{ Aire::input("variations[".$item->pivot->variation_item_id."][sku]")
                                    ->value(old("variations[".$item->pivot->variation_item_id."][sku]", $item->pivot->sku))
                                    ->groupClass('mb-0')
                                }}
                                
                                </div>
                            </td>
                            

                        
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div> 
        
        </div>
   

