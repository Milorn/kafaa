<x-layouts.main>
    <x-slot:head>
        <style>
            .hero {
                background: url('{{ asset('/images/blog/hero.png') }}');
                background-size: cover;
                background-position: bottom center;
            }
        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="relative w-screen h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">Documents</h1>
        </div>
        <div class="flex  max-w-screen-lg mx-auto my-12">
            <input type="text" class="w-full  bg-[#EDEDED] py-2 px-4 border-2 border-[#DEDEDE] border-r-0 rounded-tl-md rounded-bl-md hover:outline-none focus:outline-none" placeholder="Trouvez un article qui vous intéresse">
            <button class="btn btn-primary h-full rounded-none px-24 flex items-center gap-2 text-lg rounded-tr-md rounded-br-md font-normal">Rechercher <x-heroicon-o-magnifying-glass class="size-6 text-white stroke-2"/></button>
        </div>

        <div class="grid grid-cols-3 gap-x-5 gap-y-6 max-w-screen-xl mx-auto px-12">
            @foreach ($documents as $document)
                <div class="rounded-3xl shadow-[2px_15px_12px_0px_rgba(0,0,0,0.25)]">
                    <img class="h-72 w-full object-cover rounded-tr-3xl rounded-tl-3xl"
                        src="{{$document->getFirstMediaUrl("documents")}}">
                    <div class="px-10 py-5 flex flex-col">
                        <p class="text-trivial text-sm mb-5">{{ $document->created_at->translatedFormat('d F Y') }}</p>
                        <a href="{{ route('blog.single', ['slug' => $document->slug]) }}">
                            <h2 class="text-4xl text-primary font-bold line-clamp-2 mb-2">{{ $document->title }}</h2>
                        </a>
                        <p class="text-black text-base line-clamp-4 mb-5">
                            {{ strip_tags($document->content) }}
                        </p>
                        <a class="btn btn-primary text-center hover:cursor-pointer"
                            href="{{ route('blog.single', ['slug' => $document->slug]) }}">Telecharger</a>
                    </div>

                </div>
            @endforeach
        </div>
    </x-slot:main>
</x-layouts.main>
