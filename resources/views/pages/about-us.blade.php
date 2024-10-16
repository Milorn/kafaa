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
            <p class="font-medium text-xl text-justify">
                @lang('general.about-us.context')

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
                <a href="{{LaravelLocalization::localizeUrl('register')}}" class="btn-primary h-fit px-28 py-4 font-bold text-xl">S'inscrire</a>
            </div>
        </div>
        <div class="grid grid-cols-2 mb-5">
            <img src="{{ asset('images/about-us/vision.png') }}" class="w-full h-full" alt="Solar panels in the desert">
            <div class="flex flex-col px-32 justify-center">
                <h1 class="font-extrabold text-primary text-6xl mb-10 mt-5">Notre vision</h1>
                <p class="text-xl text-justify">
                    Les labels Kafaa-PV et Kafaa-Inara visent à garantir une meilleure qualité à tout citoyen et à
                    tout secteur souhaitant utiliser ou installer des systèmes solaires photovoltaïques ou des
                    systèmes d'éclairage public, en garantissant que l'installation répond aux critères de qualité
                    les plus élevés en termes de sécurité, de performance et de durabilité.
                    En adoptant cette labellisation, les utilisateurs finaux, notamment les collectivités locales et
                    d'autres secteurs de l'État, peuvent être assurés que leurs installations seront réalisées selon
                    les règles de l'art et conformes aux normes et standards internationaux.
                    Les labels Kafa'A PV et Kafa'A Inara offriront des installations fiables, performantes et
                    durables, tout en permettant de bénéficier des avantages économiques et environnementaux
                    de l'énergie solaire. Nous visons à promouvoir l'excellence technique et à renforcer la
                    confiance des consommateurs dans les systèmes photovoltaïques et d'éclairage public
                    installés, contribuant ainsi à un avenir plus durable et efficient sur le plan énergétique.

                </p>
            </div>
        </div>


    </x-slot:main>
</x-layouts.main>
