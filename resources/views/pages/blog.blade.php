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
        <div class="relative h-[570px] hero flex justify-center items-center">
            <h1 class="text-white text-7xl font-bold">@lang('general.blog')</h1>
        </div>

        <form action="{{ route('blog') }}" method="GET" class="flex  max-w-screen-lg mx-auto my-12">
            <input type="text" name="search" value="{{ request()->query('search') }}"
                class="w-full  bg-[#EDEDED] py-2 px-4 border-2 border-[#DEDEDE] border-r-0 rounded-tl-md rounded-bl-md hover:outline-none focus:outline-none"
                placeholder="{{__('general.blog.search_placeholder')}}">
            <button
                class="btn btn-primary h-full rounded-none px-24 flex items-center gap-2 text-lg rounded-tr-md rounded-br-md font-normal">@lang('general.search')
                <x-heroicon-o-magnifying-glass class="size-6 text-white stroke-2" /></button>
        </form>

        @if (count($posts))
            <div class="grid grid-cols-3 gap-x-8 gap-y-10 max-w-screen-xl mx-auto px-12">
                @foreach ($posts as $post)
                    <div class="rounded-3xl shadow-[2px_15px_12px_0px_rgba(0,0,0,0.25)]">
                        <img class="h-72 w-full object-cover rounded-tr-3xl rounded-tl-3xl"
                            src="{{ $post->getFirstMediaUrl('posts_images') ? $post->getFirstMediaUrl('posts_images') : asset('images/placeholder.webp') }}">
                        <div class="px-10 py-5 flex flex-col">
                            <p class="text-trivial text-sm mb-2">{{ $post->created_at->translatedFormat('d/m/Y') }}</p>
                            <a href="{{ route('blog.single', ['slug' => $post->slug]) }}">
                                <h2 class="text-2xl text-primary font-bold line-clamp-2 mb-2">{{ $post->title }}</h2>
                            </a>
                            <p class="text-black text-base line-clamp-4 mb-5">
                                {{ strip_tags($post->content) }}
                            </p>
                            <a class="btn btn-primary text-center hover:cursor-pointer"
                                href="{{ route('blog.single', ['slug' => $post->slug]) }}">@lang('general.read_more')</a>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="flex justify-center gap-4 my-10">
                {{ $posts->links() }}
            </div>
        @else
            <h4 class="text-center text-lg mb-20 mt-10">@lang('general.no_result')</h4>
        @endif
    </x-slot:main>
</x-layouts.main>
