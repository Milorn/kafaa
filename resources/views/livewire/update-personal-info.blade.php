<x-filament-breezy::grid-section md=2 title="Informations personnelles" description="Gérez vos informations personnelles">
    <x-filament::card>
        <form wire:submit.prevent="submit" class="space-y-6">
 
            {{ $this->form }}
 
            <div class="text-right">
                {{$this->getCreateFormAction()}}
            </div>
        </form>
    </x-filament::card>
</x-filament-breezy::grid-section>