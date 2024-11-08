@php
    use App\Enums\LabelStatus;
    if ($record->certificate) {
        $labelType = $record->certificate->type;
        $expiryDate = $record->certificate->expires_on;
        $expiryColor = $expiryDate->lte(today())
            ? 'text-danger-500'
            : (today()->diffInDays($expiryDate) < 30
                ? 'text-warning-500'
                : 'text-black');
        $statusText = null;
        $statusColor = null;
        $canRenew = false;
        $hasCertificateFile = $record->certificate->getFirstMedia('labels_certificates');


        if ($record->certificate->status == LabelStatus::Accepted) {
            if ($expiryDate->lte(today())) {
                $statusText = 'Expiré';
                $statusColor = 'danger';
            } else {
                $statusText = 'Valide';
                $statusColor = $record->certificate->status->getColor();
            }
            if (today()->diffInDays($expiryDate) < 30) {
                $canRenew = true;
            }
        } else {
            $statusText = $record->certificate->status->getLabel();
            $statusColor = $record->certificate->status->getColor();
        }
    }

@endphp

<x-filament-panels::page>


    @if ($record->certificate)
        <x-filament::section>
            <x-slot name="heading">
               <div class="flex items-center gap-2">
                <img class="size-12" src={{ asset('images/logo_' . $labelType->value . '.svg') }} alt="{{$labelType->value}}">
                Label {{ $record->certificate->type->getLabel() }}
               </div>
            </x-slot>

            <div class="flex flex-col gap-2">

                <h4>Date d'obention: <span
                        class="font-bold text-sm">{{ $record->certificate->starts_on->format('d/m/Y') }}</span></h4>
                <h4>
                    Date d'éxpiration:
                    <span
                        class="font-bold text-sm {{ $expiryColor }}">{{ $record->certificate->expires_on->format('d/m/Y') }}</span>
                </h4>
                <div class="flex gap-2">
                    <span>Etat:</span>
                    <x-filament::badge class="inline-block" :color="$statusColor">
                        {{ $statusText }}
                    </x-filament::badge>
                </div>
                <div class="mt-4">
                    @if ($hasCertificateFile)
                        <x-filament::button color="success" tooltip="Télécharger" size="xs"
                            wire:click="download">
                            Télécharger
                        </x-filament::button>
                    @endif
                    @if ($canRenew)
                        <x-filament::button color="info" tooltip="Demander un renouvellement" size="xs"
                            wire:click="renew">
                            Renouveler
                        </x-filament::button>
                    @endif
                </div>
            </div>
        </x-filament::section>
    @endif

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers :active-manager="$this->activeRelationManager" :managers="$relationManagers" :owner-record="$record"
            :page-class="static::class" />
    @endif
</x-filament-panels::page>
