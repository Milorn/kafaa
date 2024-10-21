<x-layouts.main>
    <x-slot:head>
        <style>
            .hero {
                background: url('{{ asset('/images/equipments/hero.png') }}');
                background-size: cover;
                background-position: bottom center;
            }
        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="relative h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">@lang('general.providers.title')</h1>
        </div>

        <form action="{{ route('equipments') }}" method="GET" class="flex  max-w-screen-lg mx-auto my-12">
            <input type="text" name="search" value="{{ request()->query('search') ?? '' }}"
                class="w-full  bg-[#EDEDED] py-2 px-4 border-2 border-[#DEDEDE] border-r-0 rounded-tl-md rounded-bl-md hover:outline-none focus:outline-none"
                placeholder="{{__('general.providers.search_placeholder')}}">
            <button
                class="btn btn-primary h-full rounded-none px-24 flex items-center gap-2 text-lg rounded-tr-md rounded-br-md font-normal">@lang('general.search')
                <x-heroicon-o-magnifying-glass class="size-6 text-white stroke-2" /></button>
        </form>

        @if (count($equipments))
            <div class="grid grid-cols-4 gap-x-5 gap-y-10 max-w-screen-xl mx-auto px-12">
                @foreach ($equipments as $equipment)
                    <div class="rounded-3xl shadow-[2px_15px_12px_0px_rgba(0,0,0,0.25)]">
                        <img class="h-64 w-full object-cover rounded-tr-3xl rounded-tl-3xl"
                            src="{{ $equipment->getFirstMediaUrl('equipments_images') ? $equipment->getFirstMediaUrl('equipments_images') : asset('images/placeholder.webp') }}">
                        <div class="px-8 pb-5 pt-2 flex flex-col">
                            <a href="{{ route('equipments.single', ['slug' => $equipment->slug]) }}">
                                <h2 class="text-xl text-primary font-bold line-clamp-2 mb-2 text-justify">{{ $equipment->name }}</h2>
                            </a>
                            <p class="text-black text-sm line-clamp-4 mb-3 text-justify">
                                {{ strip_tags($equipment->description) }}
                            </p>
                            <a class="btn btn-primary text-center text-base hover:cursor-pointer py-4"
                                href="{{ route('equipments.single', ['slug' => $equipment->slug]) }}">@lang('general.providers.view_product')</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center gap-4 my-10">
                {{ $equipments->links() }}
            </div>
        @else
            <h4 class="text-center text-lg mb-20 mt-10">Aucun résultat</h4>
        @endif
    </x-slot:main>
</x-layouts.main>
