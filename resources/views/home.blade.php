<x-layouts.main>
    <x-slot:main>


        <div class="relative">
            <div class="bg-gradient-to-r from-primary absolute w-1/2 h-full"></div>
            <div class="absolute inset-0 max-w-screen-xl mx-auto">
                <div class="grid grid-cols-2 content-center h-full">
                    <div class="pb-20">
                        <h1 class="text-white font-extrabold text-6xl">Qui sommes-nous?</h1>
                        <p class="text-white text-2xl mt-3 mb-16 pl-1 w-[80%]">
                            Kafaa is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type.
                        </p>
                        <button class="btn btn-icon bg-white text-primary">En savoir plus <x-heroicon-o-arrow-right class="size-5 text-primary stroke-2"/> </button>
                    </div>
                </div>
            </div>
            <img class="h-[946px] w-full" src="{{ asset('images/hero.png') }}">
        </div>


        <div class="bg-primary w-full h-screen">

        </div>


    </x-slot:main>
</x-layouts.main>
