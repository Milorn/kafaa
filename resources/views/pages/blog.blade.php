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
            <h1 class="text-white text-7xl font-bold">Blog</h1>
        </div>
        <div class="mt-16 grid grid-cols-3 gap-x-5 gap-y-6 max-w-screen-xl mx-auto px-12">
            @foreach ($posts as $post)
                <div class="rounded-3xl shadow-[2px_15px_12px_0px_rgba(0,0,0,0.25)]">
                    <img class="h-72 w-full object-cover rounded-tr-3xl rounded-tl-3xl"
                        src="{{ Storage::disk('public')->url($post->thumbnail) }}">
                    <div class="px-10 py-5 flex flex-col">
                        <p class="text-trivial text-sm mb-5">{{ $post->created_at->translatedFormat('d F Y') }}</p>
                        <a href="{{ route('blog.single', ['slug' => $post->slug]) }}">
                            <h2 class="text-4xl text-primary font-bold line-clamp-2 mb-2">{{ $post->title }}</h2>
                        </a>
                        <p class="text-black text-base line-clamp-4 mb-5">
                            {{ strip_tags($post->content) }}
                        </p>
                        <a class="btn btn-primary text-center hover:cursor-pointer"
                            href="{{ route('blog.single', ['slug' => $post->slug]) }}">Lire plus</a>
                    </div>

                </div>
            @endforeach
        </div>
    </x-slot:main>
</x-layouts.main>
