<header class="bg-white py-6 px-5  border-b-2 border-b-primary sticky top-0 z-50">
    <nav class="flex justify-between items-center mx-auto max-w-screen-xl">
        <div class="flex gap-3">
            <a href="{{ LaravelLocalization::localizeUrl('/') }}">
                <img class="h-14 border-r border-primary pr-3 py-2" src="{{ asset('images/cerefe_logo.png') }}"
                    alt="Logo Cerefe">
            </a>
            <img class="h-14" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label PV">
            <img class="h-14" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
        </div>
        <ul class="flex items-center gap-4">
            <li class="pb-3 @if (request()->routeIs('home')) link-active @else font-medium text-trivial @endif">
                <a href="{{ LaravelLocalization::localizeUrl('/') }}" class="hover:text-primary">@lang('general.header.welcome')</a>
            </li>
            <li class="pb-3 @if (request()->routeIs('about-us')) link-active @else font-medium text-trivial @endif">
                <a href="{{ LaravelLocalization::localizeUrl('about-us') }}"
                    class="hover:text-primary">@lang('general.header.context')</a>
            </li>
            <li class="pb-3 @if (request()->routeIs('pro')) link-active @else font-medium text-trivial @endif">
                <a href="{{ LaravelLocalization::localizeUrl('pro') }}" class="hover:text-primary">@lang('general.header.become_pro')</a>
            </li>
            <li
                class="group pb-3 hover:cursor-pointer relative @if (request()->routeIs('blog') || request()->routeIs('documents')) link-active @else font-medium text-trivial @endif">
                <span class="flex items-center gap-0.5">
                    @lang('general.header.resources')
                    <svg class="@if (request()->routeIs('blog') || request()->routeIs('documents')) fill-primary @else fill-trivial @endif size-5"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                    </svg>
                </span>
                <ul class="hidden group-hover:block absolute bg-white rounded-lg shadow-2xl px-5 py-3">
                    <li><a href="{{ LaravelLocalization::localizeUrl('blog') }}"
                            class="hover:text-primary @if (request()->routeIs('blog')) resource-link-active @else text-trivial font-medium @endif">@lang('general.header.blog')</a>
                    </li>
                    <li><a href="{{ LaravelLocalization::localizeUrl('documents') }}"
                            class="hover:text-primary @if (request()->routeIs('documents')) resource-link-active @else text-trivial font-medium @endif">@lang('general.header.documents')</a>
                    </li>
                </ul>
            </li>
            <li class="pb-3 @if (request()->routeIs('experts')) link-active @else font-medium text-trivial @endif">
                <a href="{{ LaravelLocalization::localizeUrl('experts') }}"
                    class="hover:text-primary">@lang('general.header.experts')</a>
            </li>
            <li class="pb-3 @if (request()->routeIs('equipments')) link-active @else font-medium text-trivial @endif">
                <a href="{{ LaravelLocalization::localizeUrl('equipments') }}"
                    class="hover:text-primary">@lang('general.header.providers')</a>
            </li>
            <li
                class="group pb-3 hover:cursor-pointer relative @if (request()->routeIs('blog') || request()->routeIs('documents')) link-active @else font-medium text-trivial @endif">
                <span class="flex items-center gap-0.5">
                    {{ LaravelLocalization::getCurrentLocale() }}
                    <img src="{{ asset('images/globe.svg') }}" class="size-6 fill-trivial">
                </span>
                <ul class="hidden group-hover:block absolute bg-white rounded-lg shadow-2xl px-5 py-3">
                    <li><a href="{{ LaravelLocalization::getLocalizedURL('fr', null, [], true) }}"
                            class="hover:text-primary">Français</a>
                    </li>
                    <li><a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"
                            class="hover:text-primary font-semibold">عربية</a>
                    </li>
                </ul>
            </li>
            <li>
                <div class="flex items-center flex-col gap-2">
                    <a href="{{ LaravelLocalization::localizeUrl('register') }}"
                        class="btn-primary btn-icon text-sm px-4 py-2.5">
                        @lang('general.header.register')
                        <x-heroicon-o-arrow-right class="size-4 text-white stroke-2" /> </a>
                    <p class="text-trivial text-xs text-right">
                        @lang('general.header.already_registered')
                        <a href="{{ route('filament.app.auth.login') }}"
                            class="text-primary underline decoration-primary">@lang('general.header.login')</a>
                    </p>
                </div>
            </li>

        </ul>
    </nav>
</header>
