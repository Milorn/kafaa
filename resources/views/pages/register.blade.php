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
                <p class="text-trivial text-lg mb-7">The standard chunk of Lorem Ipsum used since the 1500s is reproduced
                    below for those interested.
                    Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in
                    their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                </p>
            </div>
            <div id="register-form"></div>
        </div>
    </x-slot:main>

</x-layouts.main>
