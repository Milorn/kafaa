<x-layouts.main>
    <x-slot:head>
        <style>
            .hero {
                background: url('{{ asset('/images/about-us/hero.png') }}');
                background-size: cover;
                background-position: bottom center;
            }
        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="relative w-screen h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">Qui sommes nous ?</h1>
        </div>

        <div class="max-w-4xl mx-auto my-24">
            <p class="font-medium text-xl">
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical
                Latin
                literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at
                Hampden-Sydney
                College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum
                passage,
                and
                going through the cites of the word in classical literature, discovered the undoubtable source. Lorem
                Ipsum
                comes from sections 1.10.32 and 1.10.33 of "de
                Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a
                treatise
                on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem
                ipsum
                dolor
                sit amet..", comes from a line in section 1.10.32.

                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                Sections
                1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact
                original
                form, accompanied by English versions from the 1914 translation by H. Rackham.
            </p>
        </div>

        <div class="bg-primary py-16 px-32">
            <div class="bg-white p-14 max-w-7xl mx-auto rounded-xl flex items-center gap-20">
                <div>
                    <h1 class="text-primary font-extrabold text-5xl">Devenez installateur labellisé</h1>
                    <p class="text-trivial text-xl mt-7 text-justify">The standard chunk of Lorem Ipsum used since the
                        1500s is
                        reproduced below for those interested.
                        Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced
                        in
                        their exact original form, accompanied by English versions from the 1914 translation by H.
                        Rackham.
                    </p>
                </div>
                <button class="btn-primary h-fit px-28 py-4 font-bold text-xl">S'inscrire</button>
            </div>
        </div>
        <div class="grid grid-cols-2 mb-5">
            <img src="{{ asset('images/about-us/vision.png') }}" class="w-full" alt="Solar panels in the desert">
            <div class="flex flex-col px-32 justify-center">
                <h1 class="font-extrabold text-primary text-6xl mb-10">Notre vision</h1>
                <p class="text-xl text-justify">
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                    Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in
                    their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                    <br> <br>
                    The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.
                    Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in
                    their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                </p>
            </div>
        </div>


    </x-slot:main>
</x-layouts.main>
