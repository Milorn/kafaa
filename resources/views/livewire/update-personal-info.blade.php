<form wire:submit.prevent="submit" class="space-y-6">

    {{ $this->form }}

    <div class="text-left">
        {{ $this->getCreateFormAction() }}
    </div>
</form>
