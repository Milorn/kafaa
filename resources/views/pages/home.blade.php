<x-layouts.main>
    <x-slot:main>


        <div class="relative">
            <div class="bg-gradient-to-r from-primary absolute w-1/2 h-full"></div>
            <div class="absolute inset-0 max-w-screen-xl mx-auto">
                <div class="grid grid-cols-2 content-center h-full">
                    <div class="pb-20 px-5 xl:px-0">
                        <h1 class="text-white font-extrabold text-6xl">Contexte</h1>
                        <p class="text-white text-2xl mt-3 mb-16 pl-1 w-[80%]">
                            Kafaa is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type.
                        </p>
                        <a href="{{ route('about-us') }}" class="btn btn-icon inline-flex bg-white text-primary">En savoir
                            plus <x-heroicon-o-arrow-right class="size-5 text-primary stroke-2" /> </a>
                    </div>
                </div>
            </div>

            <img class="objet-cover w-full" src="{{ asset('images/home/hero.png') }}">

            <div class="relative max-w-screen-xl mx-auto flex justify-center px-44 w-full">
                <div class="bg-[#45AC4C]  py-8 px-4 rounded-xl shadow-[0px_9px_11px_0px_#149455] absolute -top-48 z-10">
                    <div class="flex flex-col gap-3 text-center">
                        <h1 class="text-white font-bold text-3xl">Trouvez un installateur labellisé</h1>
                        <p class="text-xl text-white opacity-60">
                            Kafaa is simply dummy text of the printing and typesetting
                            industry. <br> Lorem Ipsum has been
                        </p>
                        <form class="grid grid-cols-3 gap-6" method="GET" action="{{route('experts')}}">
                            <select name="label"
                                class="bg-white text-center gap-2 py-5 px-8 rounded-md focus:outline-none text-trivial">
                                <option disabled selected>Filtrer par Type</option>
                                <option value="epe">EPE</option>
                                <option value="pv">PV</option>
                            </select>

                            <select name="wilaya" class="bg-white text-center gap-2 py-5 px-8 rounded-md focus:outline-none text-trivial">
                                <option value="" disabled selected>Filtrer par Wilaya</option>
                                @foreach ($wilayas as $key => $wilaya)
                                    <option value="{{ $key }}">{{ $key }} - {{ $wilaya }}</option>
                                @endforeach
                            </select>
                            <button class="btn-secondary text-xl">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-primary pt-20 pb-20 relative">
            <div class="max-w-screen-xl mx-auto flex flex-col items-center gap-5">
                <h1 class="font-bold text-6xl text-white">Les labels</h1>
                <p class="text-center text-white text-xl opacity-60 max-w-screen-lg">
                    It is a long established fact that a reader will be distracted by the readable content of a page
                    when
                    looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                    distribution
                    of letters, as opposed to using 'Content here, content here', making it look like readable English.
                </p>
                <div class="max-w-2xl grid grid-cols-2 gap-8 mt-10">
                    <div class="flex flex-col items-center">
                        <div class="bg-white py-10 px-16 flex justify-center rounded-lg">
                            <img class="h-52" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label EPE">
                        </div>
                        <h2 class="text-center text-white font-bold text-3xl mt-10 mb-2">Kafa'a PV</h2>
                        <p class="text-center text-lg text-white">
                            It is a long established fact that a reader will be distracted by the readable content of a
                            page
                            when looking at its layout.
                        </p>
                        <a href="{{ route('pro') }}" class="btn-secondary mt-5 text-xl">En savoir plus</a>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="bg-white py-10 px-20 flex justify-center rounded-lg">
                            <img class="h-52" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
                        </div>
                        <h2 class="text-center text-white font-bold text-3xl mt-10 mb-2">Kafa'a Inara</h2>
                        <p class="text-center text-lg text-white">
                            It is a long established fact that a reader will be distracted by the readable content of a
                            page
                            when looking at its layout.
                        </p>
                        <a href="{{ route('pro') }}" class="btn-secondary mt-5 text-xl">En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#066938] bg-opacity-20 py-20">
            <div class="max-w-screen-xl mx-auto flex flex-col items-center gap-5 ">
                <h1 class="font-bold text-6xl text-primary">Les avantages d'un label</h1>
                <p class="text-center text-[#2E2E2E] text-xl max-w-screen-lg">
                    It is a long established fact that a reader will be distracted by the readable content of a page
                    when
                    looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
                    distribution
                    of letters, as opposed to using 'Content here, content here', making it look like readable English.
                </p>

                <div class="max-w-screen-lg grid grid-cols-3 gap-10 mt-10">
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/solar_panel.png') }}">
                        <h3 class="text-4xl text-primary font-bold">Avantage 1</h3>
                        <p class="text-center w-2/3">
                            It is a long established fact that a reader will be distracted by the readable content of a
                            when looking at its layout.
                        </p>
                    </div>
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/sun.png') }}">
                        <h3 class="text-4xl text-primary font-bold">Avantage 2</h3>
                        <p class="text-center w-2/3">
                            It is a long established fact that a reader will be distracted by the readable content of a
                            when looking at its layout.
                        </p>
                    </div>
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/bulb.png') }}">
                        <h3 class="text-4xl text-primary font-bold">Avantage 3</h3>
                        <p class="text-center w-2/3">
                            It is a long established fact that a reader will be distracted by the readable content of a
                            when looking at its layout.
                        </p>
                    </div>
                </div>
                <a href="{{ route('register') }}" class="btn-primary mt-5 text-4xl px-24 py-5">Demander une
                    labélisation</a>
            </div>
        </div>


    </x-slot:main>
</x-layouts.main>
