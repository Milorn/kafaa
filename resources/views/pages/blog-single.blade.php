<x-layouts.main>
    <x-slot:main>

        <img class="w-full max-h-[600px] object-cover"
            src="{{ $post->getFirstMediaUrl('posts_images') ? $post->getFirstMediaUrl('posts_images') : asset('images/placeholder.webp') }}">

        <div class="max-w-screen-lg mx-auto mt-5">
            <span
                class="text-sm bg-primary text-white px-3 py-0.5 rounded-sm inline-block mb-2">{{ $post->created_at->translatedFormat('d/m/Y') }}</span>
            <h1 class="text-primary text-4xl font-bold mb-8">{{ $post->title }}</h1>



            <div class="text-black text-lg text-justify rich-editor-content">
                {!! $post->content !!}
            </div>

            @if($post->type == \App\Enums\PostType::Documents)
            <div class="text-right">
                <a class="btn btn-primary"  href="{{ $post->getFirstMediaUrl('documents') }}" target="_blank">@lang('general.download')</a>
            </div>
            @endif
        </div>

        <div class="max-w-screen-lg mt-16 mb-12 mx-auto ">
            <h2 class="text-black font-bold text-3xl mb-7">Plus d'articles :</h2>
            <div class="grid grid-cols-2 gap-10">
                @foreach ($relatedPosts as $related)
                    <div class="grid grid-cols-3 shadow-xl rounded-lg">
                        <img class=" h-full object-cover rounded-tl-lg rounded-bl-lg"
                            src="{{ $related->getFirstMediaUrl('posts_images') ? $related->getFirstMediaUrl('posts_images') : asset('images/placeholder.webp') }}">
                        <div class="col-span-2 flex flex-col p-7 flex-grow">
                            <p class="text-sm text-trivial">{{ $related->created_at->translatedFormat('d/m/Y') }}</p>
                            <h3 class="text-primary text-3xl line-clamp-2 mt-1 mb-2">{{ $related->title }}</h3>
                            <p class="text-sm line-clamp-4">{{ html_entity_decode(strip_tags($related->content)) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </x-slot:main>
</x-layouts.main>
