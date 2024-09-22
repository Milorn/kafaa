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


    <div>
        @if ($record->certificate)
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <img class="size-12" src={{ asset('images/logo_' . $labelType->value . '.svg') }}
                            alt="{{ $labelType->value }}">
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
                    @if ($canRenew)
                        <div class="mt-4">
                            <x-filament::button color="info" tooltip="Demander un renouvellement" size="xs"
                                wire:click="renew">
                                Renouveler
                            </x-filament::button>
                        </div>
                    @endif
                </div>
            </x-filament::section>
        @else
            <div class="text-3xl text-center">Pas de Label</div>
        @endif
    </div>
</x-filament-panels::page>
