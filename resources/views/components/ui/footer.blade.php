<footer>
    <div class="bg-white pb-16 pt-12 mx-auto max-w-screen-xl flex justify-between items-end">
        <div class="flex flex-col gap-10">
            <img class="h-20 p-1 object-contain" src="{{ asset('images/cerefe_logo.png') }}" alt="Logo Cerefe">
            <div class="flex flew-row justify-end gap-10">
                <img class="h-28" src="{{ asset('images/logo_pv.svg') }}" alt="Logo Label PV">
                <img class="h-28" src="{{ asset('images/logo_epe.svg') }}" alt="Logo Label EPE">
            </div>
        </div>
        <ul class="text-md flex flex-col justify-center gap-2">
            <li><a href="#">Mentions légales</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
            <li><a href="#">FAQ particulier</a></li>
            <li><a href="#">FAQ professionel</a></li>
            <li><a href="#">Photothéque</a></li>
        </ul>
        <ul class="text-md flex flex-col justify-center gap-2">
            <li><a href="#">Médiathéque</a></li>
            <li><a href="#">Choisissez une ville</a></li>
            <li><a href="#">Espace presse</a></li>
            <li><a href="{{route('register')}}">Nous rejoindre</a></li>
            <li><a href="{{route('filament.app.pages.dashboard')}}">Espace pro</a></li>
        </ul>
        <ul class="text-md flex flex-col justify-center gap-2">
            <li>
                <h3 class="text-xl text-primary font-bold">Nous contacter</h3>
            </li>
            <li class="flex items-start gap-1 ml-2">
                <img src="{{ asset('images/mail.svg') }}" alt="Mail icon" class="size-6">
                <p class="mt-[-2px]">contact@cerefe.gov.dz</p>
            </li>
            <li class="flex items-start gap-1 ml-2">
                <img src="{{ asset('images/call.svg') }}" alt="Call icon" class="size-6">
                <p>023 50 75 40</p>
            </li>
            <li class="flex items-start gap-1 ml-2">
                <img src="{{ asset('images/laptop.svg') }}" alt="Laptop icon" class="size-6">
                <p>023 50 73 82</p>
            </li>
            <li class="flex items-start gap-1 ml-2">
                <img src="{{ asset('images/location.svg') }}" alt="Location icon" class="size-7 ml-[-1px]">
                <p>23, Rue Dr Asslh Slimane, <br> Telemly, Alger, Algérie </p>
            </li>
        </ul>
    </div>
    <div class="bg-primary text-center py-4">
        <span class="text-white opacity-60 text-sm">Kafaa designed by Educe-IT {{ today()->year }}@</span>
    </div>
</footer>
