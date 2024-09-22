@php
    use App\Enums\LabelType;
@endphp

<x-layouts.main>
    <x-slot:head>
        <style>

        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="max-w-screen-xl mx-auto">
            <h1 class="mt-14 mb-11 text-primary text-4xl font-bold">Espace experts</h1>
            <form class="grid grid-cols-4 gap-x-5 mb-6" method="GET" action="{{ route('experts') }}">
                <input name="search"
                    class="bg-[#EDEDED] py-3 px-2 text-center border border-[#DEDEDE] rounded-md focus:outline-none"
                    type="text" placeholder="Prénom Nom" value="{{ request()->query('search') }}">
                <select name="label"
                    class="border border-[#D0D0D0]  rounded-md text-center text-primary px-2  focus:outline-none">
                    <option value="" disabled selected>Label</option>
                    <option value="">Aucun</option>
                    <option value="epe" @selected(request()->query('label') == 'epe')>EPE</option>
                    <option value="pv" @selected(request()->query('label') == 'pv')>PV</option>
                </select>
                <select name="wilaya"
                    class="border border-[#D0D0D0]  rounded-md text-center text-primary px-2  focus:outline-none">
                    <option value="" disabled selected>Wilaya</option>
                    <option value="">Aucune</option>
                    @foreach ($wilayas as $key => $wilaya)
                        <option value="{{ $key }}" @selected(request()->query('wilaya') == $key)>{{ $key }} -
                            {{ $wilaya }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary font-semibold">Rechercher</button>
            </form>
            @if (count($experts))
                <div class="grid grid-cols-6 gap-5">
                    @foreach ($experts as $expert)
                        <div class="p-3 shadow-xl rounded-xl flex flex-col items-center">
                            <div class="flex gap-4 items-center mb-3.5">
                                <img class="size-16 rounded-full"
                                    src="{{ $expert->getFirstMedia('experts_avatars') ?? asset('images/placeholder.webp') }}">
                                <div class="flex flex-col">
                                    @if ($expert->label == LabelType::PV)
                                        <span class="text-xs text-white rounded p-0.5 bg-[#8DBE22] w-fit">PV</span>
                                    @else
                                        <span class="text-xs text-white rounded p-0.5 bg-[#FAB513] w-fit">EPE</span>
                                    @endif
                                    <span class="text-sm font-bold text-primary">{{ $expert->fname }}</span>
                                    <span class="text-sm font-bold text-primary">{{ $expert->lname }}</span>
                                    <span
                                        class="text-xs font-semibold text-[#AFAFAF]">{{ $expert->wilaya ? $expert->wilaya->name : 'Aucune' }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-[#AFAFAF]">Expérience:
                                    {{ $expert->years_of_experience ? $expert->years_of_experience . ' an(s)' : 'Non specifié' }}
                                </p>
                                <span class="text-xs font-semibold text-[#AFAFAF]">N° de projets:
                                    {{ $expert->number_of_projects ?? 'Non specifié' }} </span>
                                    <a href="{{route('experts.single', ['expert' => $expert])}}" class="btn btn-primary w-full py-2.5 mt-3 text-xs font-bold inline-block text-center">Voir profile</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-center gap-4 my-10">
                    {{ $experts->links() }}
                </div>
            @else
                <h4 class="text-center text-lg mb-20 mt-10">Aucun résultat</h4>
            @endif
        </div>
    </x-slot:main>
</x-layouts.main>
