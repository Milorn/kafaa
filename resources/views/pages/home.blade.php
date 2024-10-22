<x-layouts.main>
    <x-slot:main>


        <div class="relative">
            <div class="bg-gradient-to-r from-primary absolute w-1/2 h-full"></div>
            <div class="absolute inset-0 max-w-screen-xl mx-auto">
                <div class="grid grid-cols-2 content-center h-full">
                    <div class="pb-20 px-5 xl:px-0">
                        <h1 class="text-white font-extrabold text-6xl">@lang('general.context')</h1>
                        <p class="text-white text-2xl mt-3 mb-16 pl-1 w-[80%]">
                            @lang('general.home.hero_text')
                        </p>
                        <a href="{{ route('about-us') }}" class="btn btn-icon inline-flex bg-white text-primary">
                            @lang('general.home.cta')
                            <x-heroicon-o-arrow-right class="size-5 text-primary stroke-2" /> </a>
                    </div>
                </div>
            </div>

            <img class="objet-cover w-full" src="{{ asset('images/home/hero.png') }}">

            <div class="relative max-w-screen-xl mx-auto flex justify-center px-44 w-full">
                <div class="bg-[#45AC4C]  py-8 px-4 rounded-xl shadow-[0px_9px_11px_0px_#149455] absolute -top-48 z-10">
                    <div class="flex flex-col gap-3 text-center">
                        <h1 class="text-white font-bold text-3xl">@lang('general.home.expert.title')</h1>
                        <p class="text-xl text-white opacity-60">
                           @lang('general.home.expert.subtitle')
                        </p>
                        <form class="grid grid-cols-3 gap-6" method="GET" action="{{ route('experts') }}">
                            <select name="label"
                                class="bg-white text-center gap-2 py-5 rounded-md focus:outline-none text-trivial">
                                <option disabled selected>@lang('general.home.expert.filter_by_type')</option>
                                <option value="epe">@lang('general.EPE')</option>
                                <option value="pv">@lang('general.PV')</option>
                            </select>

                            <select name="wilaya"
                                class="bg-white text-center gap-2 py-5 px-8 rounded-md focus:outline-none text-trivial">
                                <option value="" disabled selected>@lang('general.home.expert.filter_by_wilaya')</option>
                                @foreach ($wilayas as $key => $wilaya)
                                    <option value="{{ $key }}">{{ $key }} - {{ $wilaya }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn-secondary text-xl">@lang('general.search')</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-primary pt-20 pb-20 relative">
            <div class="max-w-screen-xl mx-auto flex flex-col items-center gap-5">
                <h1 class="font-bold text-6xl text-white">@lang('general.home.labels.title')</h1>
                <p class="text-center text-white text-xl opacity-60 max-w-screen-lg">
                    @lang('general.home.labels.text')
                </p>
                <div class="max-w-2xl grid grid-cols-2 gap-8 mt-10">
                    <div class="flex flex-col items-center">
                        <div class="bg-white py-10 px-16 flex justify-center rounded-lg">
                            <img class="h-52" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label PV">
                        </div>
                        <h2 class="text-center text-white font-bold text-3xl mt-10 mb-2">@lang('general.home.labels.pv')</h2>

                        <a href="{{ route('pro') }}" class="btn-secondary mt-5 text-xl">@lang('general.know_more')</a>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="bg-white py-10 px-20 flex justify-center rounded-lg">
                            <img class="h-52" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
                        </div>
                        <h2 class="text-center text-white font-bold text-3xl mt-10 mb-2">@lang('general.home.labels.epe')</h2>
        
                        <a href="{{ route('pro') }}" class="btn-secondary mt-5 text-xl">@lang('general.know_more')</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-[#066938] bg-opacity-20 py-20">
            <div class="max-w-screen-xl mx-auto flex flex-col items-center gap-5 ">
                <h1 class="font-bold text-6xl text-primary">@lang('general.home.advantages.title')</h1>
                <p class="text-center text-[#2E2E2E] text-xl max-w-screen-lg">
                    @lang('general.home.advantages.text')
                </p>

                <div class="max-w-screen-lg grid grid-cols-3 gap-10 mt-10">
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/solar_panel.png') }}">
                        <h3 class="text-4xl text-primary font-bold">@lang('general.home.advantages1.title')</h3>
                        <p class="text-center w-2/3">
                            @lang('general.home.advantages1.text')
                        </p>
                    </div>
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/sun.png') }}">
                        <h3 class="text-4xl text-primary font-bold">@lang('general.home.advantages2.title')</h3>
                        <p class="text-center w-2/3">
                            @lang('general.home.advantages2.text')
                        </p>
                    </div>
                    <div class="flex flex-col gap-8 justify-center items-center">
                        <img class="h-52 object-contain" src="{{ asset('images/home/bulb.png') }}">
                        <h3 class="text-4xl text-primary font-bold">@lang('general.home.advantages3.title')</h3>
                        <p class="text-center w-2/3">
                            @lang('general.home.advantages3.text')
                        </p>
                    </div>
                </div>
                <a href="{{ route('register') }}" class="btn-primary mt-5 text-4xl px-24 py-5">@lang('general.home.advantages.cta')</a>
            </div>
        </div>


    </x-slot:main>
</x-layouts.main>
