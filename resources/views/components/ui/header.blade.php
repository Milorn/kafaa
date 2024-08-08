<header class="bg-white py-6 px-5 border-b-2 border-b-primary sticky top-0 z-50">
    <nav class="flex justify-between items-center mx-auto max-w-screen-xl">
        <div class="flex gap-6">
            <img class="h-16 border-r border-primary pr-6 py-2" src="{{asset('images/cerefe_logo.png')}}" alt="Logo Cerefe">
            <img class="h-14" src="{{asset('images/label_pv_logo.png')}}" alt="Logo Label PV">
            <img class="h-14" src="{{asset('images/label_epe_logo.png')}}" alt="Logo Label EPE">
        </div>
        <ul>
            <li class="inline-block mx-2 pb-3 @if(request()->routeIs('home')) link-active @else font-medium text-trivial @endif"><a href="/">Acceuil</a></li>
            <li class="inline-block mx-2 pb-3 @if(request()->routeIs('about-us')) link-active @else font-medium text-trivial @endif"><a href="/about-us">Qui sommes nous ?</a></li>
            <li class="inline-block mx-2 pb-3 @if(request()->routeIs('pro')) link-active @else font-medium text-trivial @endif"><a href="/pro">Devenir pro</a></li>
            <li class="inline-block mx-2 pb-3 @if(request()->routeIs('resources')) link-active @else font-medium text-trivial @endif"><a href="/resources">Ressources</a></li>
            <li class="inline-block ml-12">
                <div class="flex flex-col gap-2">
                    <button class="btn-primary btn-icon">S'enregistrer <x-heroicon-o-arrow-right class="size-5 text-white stroke-2"/> </button>
                    <p class="text-trivial text-xs text-right">Déja inscrit ? <span class="text-primary underline decoration-primary">se connecter</span></p>
                </div>
            </li>
        </ul>
    </nav>
</header>