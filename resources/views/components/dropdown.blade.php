@props(['title', 'menu', 'icon'])

@php
    $is = [];
    foreach ($menu as $key => $value) {
        $is[] = $key.'*';
    }
@endphp


<li>
    <button 
            type="button"
            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
            aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-{{ $title }}" >
            @svg($icon, 'w-6 h-6 text-gray-500')
        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{ $title }}</span>
        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </button>

    <ul id="dropdown-{{ $title }}" class="{{ request()->is($is) ? '' : 'hidden' }} py-2 space-y-2">
        @foreach ($menu as $key => $item)
            <li>
                <a class="{{ request()->is($key.'*') ? 'active' : '' }}" href="{{ route($key.'.index') }}" >
                    {{ $item }}                            
                </a>
            </li>
        @endforeach
    </ul>
</li>