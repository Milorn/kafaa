<x-layouts.main>
    <x-slot:main>

        <div class="max-w-screen-xl mx-auto mt-11 mb-16">
            <h1 class="text-primary text-5xl font-bold mb-7">{{ $equipment->name }}</h1>
            <div class="grid grid-cols-3 gap-5 mx-auto mb-16">
                @foreach ($equipment->getMedia('equipments_images') as $media)
                    <img class="rounded-lg h-96 w-full object-cover shadow-lg" src="{{ $media->getUrl() }}" alt="">
                @endforeach
            </div>
            <div class="grid grid-cols-6 gap-x-32">
                <div class="mb-10 col-span-4">
                    <h3 class="text-primary  font-bold text-3xl mb-3">Description</h3>
                    <p class="text-base text-justify mb-10">{{ $equipment->description }}</p>
                    <h3 class="text-primary  font-bold text-3xl mb-3">Autres produits</h3>
                    <div class="grid grid-cols-4 gap-5">
                        @foreach ($others as $other)
                            <div class="rounded-3xl shadow-[2px_15px_12px_0px_rgba(0,0,0,0.25)]">
                                <img class="h-40 w-full object-cover rounded-tr-3xl rounded-tl-3xl"
                                    src="{{ $other->getFirstMediaUrl('equipments_images') ? $other->getFirstMediaUrl('equipments_images') : asset('images/placeholder.webp') }}">
                                <div class="px-5 pb-5 pt-2 flex flex-col">
                                    <a href="{{ route('equipments.single', ['slug' => $other->slug]) }}">
                                        <h2 class="text-base text-primary font-bold line-clamp-2 mb-2">
                                            {{ $equipment->name }}</h2>
                                    </a>
                                    <a class="btn btn-primary text-center text-base hover:cursor-pointer py-2"
                                        href="{{ route('equipments.single', ['slug' => $equipment->slug]) }}">Voir
                                        produit
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-span-2">
                    <h3 class="text-primary font-bold text-3xl mb-4">Fournisseur</h3>
                    @if($equipment->provider)
                        <div class="shadow-lg p-6 rounded-xl">
                            <img class="mb-10" src="{{$equipment->provider->getFirstMediaUrl('providers_logos')}}" alt="">
                            <h2 class="font-bold text-lg text-primary line-clamp-2 mb-2">{{$equipment->provider->name}}</h2>
                            <ul class="flex flex-col gap-2">
                                <li class="flex items-center text-sm text-gray-800">
                                    <img class="size-7" src="{{asset('images/location.svg')}}" alt="Map icon">
                                    {{$equipment->provider->address}}
                                </li>
                                <li class="flex items-center text-sm text-gray-800">
                                    <img class="size-7" src="{{asset('images/call.svg')}}" alt="Phone icon">
                                    {{$equipment->provider->phone}}
                                </li>
                            </ul>
                        </div>
                    @else
                        <p class="text-center font-semibold text-xl text-gray-700">Aucun</p>
                    @endif
                </div>

            </div>
        </div>

    </x-slot:main>
</x-layouts.main>
