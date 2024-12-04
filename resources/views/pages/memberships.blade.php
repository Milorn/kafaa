<x-layouts.main>

    <x-slot:main>
        <div class="bg-primary pt-20 pb-20 relative">
            <h1 class="font-bold text-6xl text-white text-center">@lang('general.memberships.title')</h1>

            <div class="max-w-screen-xl mx-auto grid grid-cols-3 gap-5 mt-10">
                <div class="bg-white p-10 rounded-lg">
                    <div class="flex flex-col gap-2 items-center mb-4">
                        <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                        <h2 class="text-center font-semibold text-2xl">@lang('general.memberships.free')</h2>
                        <h3 class="text-xl">@lang('general.price', ['price' => 39])</h3>
                        <hr class="bg-blackborder-2 w-full mt-5 mb-3">
                    </div>
                    <ul class="text-center space-y-3">
                        <li>@lang('general.memberships.feature1')</li>
                        <li>@lang('general.memberships.feature2')</li>
                        <li>@lang('general.memberships.feature3')</li>
                        <li>@lang('general.memberships.feature4')</li>
                    </ul>
                    <div class="text-center mt-12">
                        <button class="btn btn-primary">
                            @lang('general.consult')
                        </button>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-lg">
                    <div class="flex flex-col gap-2 items-center mb-4">
                        <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                        <h2 class="text-center font-semibold text-2xl">@lang('general.memberships.business')</h2>
                        <h3 class="text-xl">@lang('general.price', ['price' => 99])</h3>
                        <hr class="bg-blackborder-2 w-full mt-5 mb-3">
                    </div>
                    <ul class="text-center space-y-3">
                        <li>@lang('general.memberships.feature1')</li>
                        <li>@lang('general.memberships.feature2')</li>
                        <li>@lang('general.memberships.feature3')</li>
                        <li>@lang('general.memberships.feature4')</li>
                    </ul>
                    <div class="text-center mt-12">
                        <button class="btn btn-primary">
                            @lang('general.consult')
                        </button>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-lg">
                    <div class="flex flex-col gap-2 items-center mb-4">
                        <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                        <h2 class="text-center font-semibold text-2xl">@lang('general.memberships.vip')</h2>
                        <h3 class="text-xl">@lang('general.price', ['price' => 199])</h3>
                        <hr class="bg-blackborder-2 w-full mt-5 mb-3">
                    </div>
                    <ul class="text-center space-y-3">
                        <li>@lang('general.memberships.feature1')</li>
                        <li>@lang('general.memberships.feature2')</li>
                        <li>@lang('general.memberships.feature3')</li>
                        <li>@lang('general.memberships.feature4')</li>
                    </ul>
                    <div class="text-center mt-12">
                        <button class="btn btn-primary">
                            @lang('general.consult')
                        </button>
                    </div>
                </div>


            </div>

        </div>


    </x-slot:main>
</x-layouts.main>
