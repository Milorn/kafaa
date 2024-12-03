<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Mes abonnements
        </x-slot>
        <h1>Vous n'avez aucun abonnement actif.</h1>
    </x-filament::section>
    <div class="grid grid-cols-3 gap-5">
        <x-filament::card>
            <div class="flex flex-col gap-2 items-center mb-4">
                <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                <h2 class="text-center font-semibold text-2xl">Gratuit</h2>
                <h3 class="text-xl">39€</h3>
                <hr class="bg-blackborder-2 w-full mt-5 mb-3">
            </div>
            <ul class="text-center space-y-3">
               <li>Accés aux formations</li> 
               <li>Labélisation</li> 
               <li>Visibilité</li> 
               <li>Equipements</li> 
            </ul>
            <div class="text-center mt-7">
                <x-filament::button size="xl" icon="heroicon-o-eye">
                    Consulter
                </x-filament::button>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="flex flex-col gap-2 items-center mb-4">
                <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                <h2 class="text-center font-semibold text-2xl">Business</h2>
                <h3 class="text-xl">99€</h3>
                <hr class="bg-blackborder-2 w-full mt-5 mb-3">
            </div>
            <ul class="text-center space-y-3">
               <li>Accés aux formations</li> 
               <li>Labélisation</li> 
               <li>Visibilité</li> 
               <li>Equipements</li> 
            </ul>
            <div class="text-center mt-7">
                <x-filament::button size="xl" icon="heroicon-o-eye">
                    Consulter
                </x-filament::button>
            </div>
        </x-filament::card>
        <x-filament::card>
            <div class="flex flex-col gap-2 items-center mb-4">
                <x-filament::icon icon="heroicon-o-user" class="size-10"></x-filament::icon>
                <h2 class="text-center font-semibold text-2xl">VIP</h2>
                <h3 class="text-xl">199€</h3>
                <hr class="bg-blackborder-2 w-full mt-5 mb-3">
            </div>
            <ul class="text-center space-y-3">
               <li>Accés aux formations</li> 
               <li>Labélisation</li> 
               <li>Visibilité</li> 
               <li>Equipements</li> 
            </ul>
            <div class="text-center mt-7">
                <x-filament::button size="xl" icon="heroicon-o-eye">
                    Consulter
                </x-filament::button>
            </div>
        </x-filament::card>
    </div>

</x-filament-panels::page>
