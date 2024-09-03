<x-layouts.main>
    <x-slot:main>
        <div class="relative">
            <img class="w-full min-h-96" src="{{$post->getFirstMediaUrl("posts_images")}}">
            <div class="absolute bottom-16 w-full">
                <div class="max-w-screen-lg mx-auto">
                    <span
                        class="text-sm bg-primary text-white px-3 py-0.5 rounded-sm inline-block mb-3">{{ $post->created_at->translatedFormat('d F Y') }}</span>
                    <h1 class="text-white text-8xl font-bold">{{ $post->title }}</h1>
                </div>
            </div>
        </div>

        <div class="max-w-screen-lg mx-auto mt-11 mb-16">
            <p class="text-black text-lg text-justify">
                {!! $post->content !!}
            </p>
        </div>

        <div class="max-w-screen-lg mt-16 mb-12 mx-auto ">
            <h2 class="text-black font-bold text-3xl mb-7">Plus d'articles :</h2>
            <div class="grid grid-cols-2 gap-10">
                @foreach ($relatedPosts as $related)
                    <div class="flex flex-row shadow-xl rounded-lg">
                        <img class="w-48 rounded-tl-lg rounded-bl-lg"
                            src="{{$related->getFirstMediaUrl("posts_images") }}">
                        <div class="flex flex-col p-7 flex-grow">
                            <p class="text-sm text-trivial">{{ $related->created_at->translatedFormat('d F Y') }}</p>
                            <h3 class="text-primary text-3xl line-clamp-2 mt-1 mb-2">{{ $related->title }}</h3>
                            <p class="text-sm line-clamp-4">{{ html_entity_decode(strip_tags($related->content)) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </x-slot:main>
</x-layouts.main>
