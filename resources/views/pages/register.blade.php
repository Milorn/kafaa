<x-layouts.main>
    <x-slot:head>
        @vite('resources/css/forms.css')
        @viteReactRefresh
        @vite('resources/js/register.jsx')
    </x-slot:head>

    <x-slot:main>
        <div class="my-16 max-w-3xl mx-auto">
            <div class="text-center">
                <h1 class="text-primary font-bold text-4xl mb-7">Demandez votre labélisation</h1>
            </div>
            <div id="register-form"></div>
        </div>
    </x-slot:main>

</x-layouts.main>
