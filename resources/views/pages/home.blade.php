<x-layouts.main>
    <x-slot:main>


        <div class="relative">
            <div class="bg-gradient-to-r from-primary absolute w-1/2 h-full"></div>
            <div class="absolute inset-0 max-w-screen-xl mx-auto">
                <div class="grid grid-cols-2 content-center h-full">
                    <div class="pb-20 px-5 xl:px-0">
                        <h1 class="text-white font-extrabold text-6xl">@lang('general.context')</h1>
                        <p class="text-white text-2xl mt-3 mb-16 pl-1 w-[80%] text-justify">
                            @lang('general.home.hero_text')
                        </p>
                        <a href="{{ route('about-us') }}" class="btn btn-icon inline-flex bg-white text-primary">
                            @lang('general.home.cta')
                            <x-heroicon-o-arrow-right class="size-5 text-primary stroke-2" /> </a>
                    </div>
                </div>
            </div>

            <img class="objet-cover w-full" src="{{ LaravelLocalization::getCurrentLocale() == 'ar' ? asset('images/home/hero-ar.png') : asset('images/home/hero.png')}}" >
        </div>

        <div class="bg-white flex justify-center py-20 px-36">
            <iframe class="w-full" width="1280" height="725" src="https://www.youtube.com/embed/O7JFxMaNvno" title="Vidéo label kafa&#39;a pv" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
