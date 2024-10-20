<x-layouts.main>
    <x-slot:head>
        <style>
            .hero {
                background: url('{{ asset('/images/about-us/hero.png') }}');
                background-size: cover;
                background-position: bottom center;
            }
        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="relative h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">@lang('general.context')</h1>
        </div>

        <div class="max-w-4xl mx-auto my-24">
            <p class="font-medium text-xl text-justify">
                @lang('general.context.hero')

            </p>
        </div>

        <div class="bg-primary py-16 px-32">
            <div class="bg-white p-14 max-w-7xl mx-auto rounded-xl flex items-center gap-20">
                <div>
                    <h1 class="text-primary font-extrabold text-5xl">@lang('general.context.expert.title')</h1>
                    <p class="text-trivial text-xl mt-7 text-justify">@lang('general.context.expert.text')</p>
                </div>
                <a href="{{LaravelLocalization::localizeUrl('register')}}" class="btn-primary h-fit px-28 py-4 font-bold text-xl">@lang('general.context.expert.register')</a>
            </div>
        </div>
        <div class="grid grid-cols-2 mb-5">
            <img src="{{ asset('images/about-us/vision.png') }}" class="w-full h-full" alt="Solar panels in the desert">
            <div class="flex flex-col px-32 justify-center">
                <h1 class="font-extrabold text-primary text-6xl mb-10 mt-5">@lang('general.context.vision.title')</h1>
                <p class="text-xl text-justify">@lang('general.context.vision.text')</p>
            </div>
        </div>


    </x-slot:main>
</x-layouts.main>
