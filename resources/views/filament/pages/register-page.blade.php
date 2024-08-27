<x-filament-panels::page.simple>

    <style>
        .fi-input {
            background-color: red
        }
    </style>

    <x-filament-panels::form wire:submit="register">
        {{ $this->form }}
    </x-filament-panels::form>


</x-filament-panels::page.simple>
