@props(['home'])
<form class="sm:pr-3" >
    <label for="products-search" class="sr-only">Search</label>
    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
        <input type="text" name='q' placeholder="Buscar" value="{{ request()->q }}" 
            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 "
          >
    </div>
</form>
<div class="flex items-center w-full sm:justify-end">
    <div class="flex pl-2 space-x-1">
        @if (request()->q)
            <a href="{{ $home }}"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 d">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        @endif
       
      
    </div>
</div>
