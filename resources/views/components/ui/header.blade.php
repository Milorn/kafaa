<header class="bg-white py-6 px-5  border-b-2 border-b-primary sticky top-0 z-50">
    <nav class="flex justify-between items-center mx-auto max-w-screen-xl">
        <div class="flex gap-3">
            <a href="/">
                <img class="h-14 border-r border-primary pr-3 py-2" src="{{ asset('images/cerefe_logo.png') }}"
                    alt="Logo Cerefe">
            </a>
            <img class="h-14" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label PV">
            <img class="h-14" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
        </div>
        <ul class="flex items-center gap-4">
            <li
                class="pb-3 @if (request()->routeIs('home')) link-active @else font-medium text-trivial @endif">
                <a href="/" class="hover:text-primary">Accueil</a>
            </li>
            <li
                class="pb-3 @if (request()->routeIs('about-us')) link-active @else font-medium text-trivial @endif">
                <a href="/about-us" class="hover:text-primary">Contexte</a>
            </li>
            <li
                class="pb-3 @if (request()->routeIs('pro')) link-active @else font-medium text-trivial @endif">
                <a href="/pro" class="hover:text-primary">Devenir pro</a>
            </li>
            <li
                class="group pb-3 hover:cursor-pointer relative @if (request()->routeIs('blog') || request()->routeIs('documents')) link-active @else font-medium text-trivial @endif">
                <span class="flex items-center gap-0.5">
                    Ressources
                    <svg class="@if (request()->routeIs('blog') || request()->routeIs('documents')) fill-primary @else fill-trivial @endif size-5"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                    </svg>
                </span>
                <ul class="hidden group-hover:block absolute bg-white rounded-lg shadow-2xl px-5 py-3">
                    <li><a href="/blog"
                            class="hover:text-primary @if (request()->routeIs('blog')) resource-link-active @else text-trivial font-medium @endif">Blog</a>
                    </li>
                    <li><a href="/documents"
                            class="hover:text-primary @if (request()->routeIs('documents')) resource-link-active @else text-trivial font-medium @endif">Documents</a>
                    </li>
                </ul>
            </li>
            <li
                class="pb-3 @if (request()->routeIs('experts')) link-active @else font-medium text-trivial @endif">
                <a href="/experts" class="hover:text-primary">Installateurs</a>
            </li>
            <li
                class="pb-3 @if (request()->routeIs('equipments')) link-active @else font-medium text-trivial @endif">
                <a href="/equipments" class="hover:text-primary">Fournisseurs</a>
            </li>
            <li>
                <div class="flex items-center flex-col gap-2">
                    <a href="/register" class="btn-primary btn-icon text-sm px-4 py-2.5">S'enregistrer <x-heroicon-o-arrow-right
                            class="size-4 text-white stroke-2" /> </a>
                    <p class="text-trivial text-xs text-right">
                        Déja inscrit ?
                        <a href="{{ route('filament.app.auth.login') }}"
                            class="text-primary underline decoration-primary">se connecter</a>
                    </p>
                </div>
            </li>
        </ul>
    </nav>
</header>
