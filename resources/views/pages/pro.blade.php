<x-layouts.main>
    <x-slot:head>
        <style>
            .hero {
                background: url('{{ asset('/images/pro/hero.png') }}');
                background-size: cover;
                background-position: bottom center;
            }
        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="relative h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">@lang('general.pro.title')</h1>
        </div>
        <div class="flex flex-col items-center my-16 max-w-3xl mx-auto">
            <h2 class="text-5xl font-extrabold text-primary mb-6">@lang('general.pro.expert.title')</h2>
            <p class="text-trivial text-lg text-justify">
                @lang('general.pro.expert.text')
            </p>

            <div class="max-w-2xl grid grid-cols-2 gap-8 mt-16">
                <div class="flex flex-col items-center gap-y-28">
                    <img class="h-52" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label EPE">
                    <a href="{{route('register')}}" class="btn-primary mt-5 text-xl px-28">@lang('general.pro.expert.register')</a>
                </div>

                <div class="flex flex-col items-center gap-y-28">
                    <img class="h-52" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
                    <a href="{{route('register')}}" class="btn-primary mt-5 text-xl px-28">@lang('general.pro.expert.register')</a>
                </div>
            </div>
        </div>


        <div class="bg-primary p-24">
            <h1 class="text-white font-extrabold text-5xl mb-9 text-center">Témoignages</h1>

            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <x-ui.testimony/>
                    </div>
                    <div class="swiper-slide">
                        <x-ui.testimony/>
                    </div>
                    <div class="swiper-slide">
                        <x-ui.testimony/>
                    </div>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev !text-white"></div>
                <div class="swiper-button-next !text-white"></div>
            </div>
        </div>


        <x-slot:end>
            @vite('resources/js/pro.js')
        </x-slot:end>
    </x-slot:main>
</x-layouts.main>
