<x-filament-breezy::grid-section md=2 title="Informations professionnelles"
    description="Gérez vos informations professionnelles">
    <x-filament::card>
        @if ($this->userData)
            <form wire:submit.prevent="submit" class="space-y-6">

                {{ $this->form }}

                <div class="text-right">
                    {{ $this->getCreateFormAction() }}
                </div>
            </form>
        @else
            <h3>Pas de données professionnelles pour l'administrateur</h3>
        @endif
    </x-filament::card>
</x-filament-breezy::grid-section>
