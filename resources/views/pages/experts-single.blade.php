@php
    use App\Enums\LabelType;
@endphp

<x-layouts.main>
    <x-slot:main>
        <div class="max-w-screen-xl mx-auto my-9 px-5">
            <div class="bg-[#F4F4F4] rounded-lg grid grid-cols-3 py-12 px-20 gap-x-12  place-items-center">
                <img class="rounded-full w-full aspect-square"
                    src="{{ $expert->getFirstMedia('experts_avatars') ?? asset('images/placeholder.webp') }}">
                <div class="flex flex-col gap-y-4">
                    @if ($expert->label == LabelType::PV)
                        <span class="text-white rounded py-0.5 px-3 bg-[#8DBE22] w-fit">@lang('general.PV')</span>
                    @else
                        <span class="text-white rounded p-0.5 bg-[#FAB513] w-fit">@lang('general.EPE')</span>
                    @endif
                    <div>
                        <h1 class="text-primary font-bold text-4xl">{{ $expert->fname }}</h1>
                        <h1 class="text-primary font-bold text-4xl">{{ $expert->lname }}</h1>
                    </div>
                    <span
                        class="text-2xl font-semibold text-[#AFAFAF]">{{ $expert->wilaya ? $expert->wilaya->name : 'Aucune' }}</span>
                    <div>
                        <p class="font-semibold text-[#AFAFAF]">@lang('general.experts.experience'):
                            {{ $expert->years_of_experience ? $expert->years_of_experience . ' ' . __('general.experts.years') : __('general.not_specified') }}
                        </p>
                        <span class="font-semibold text-[#AFAFAF]">@lang('general.experts.number_of_projects'):
                            {{ $expert->number_of_projects ?? __('general.not_specified') }} </span>
                    </div>
                </div>
                <div class="bg-white rounded-md border border-[#ECECEC]  h-fit py-4 px-10 hover:cursor-pointer">
                    <ul class="flex flex-col gap-3">
                        <li class="flex items-center gap-4">
                            <img class="size-6" src="{{ asset('images/pdf.svg') }}" alt="">
                            <span class="text-primary">@lang('general.resumee')</span>
                        </li>
                        <li class="flex items-center gap-4 text-sm text-gray-800">
                            <img class="size-7" src="{{ asset('images/location.svg') }}" alt="Map icon">
                            {{ $expert->address }}
                        </li>
                        <li class="flex items-center gap-4 text-sm text-gray-800">
                            <img class="size-7" src="{{ asset('images/call.svg') }}" alt="Phone icon">
                            {{ $expert->phone }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </x-slot:main>
</x-layouts.main>
