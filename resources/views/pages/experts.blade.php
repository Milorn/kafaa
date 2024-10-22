@php
    use App\Enums\LabelType;
@endphp

<x-layouts.main>
    <x-slot:head>
        <style>

        </style>
    </x-slot:head>
    <x-slot:main>
        <div class="max-w-screen-xl mx-auto px-5">
            <h1 class="mt-14 mb-11 text-primary text-4xl font-bold">@lang('general.experts.title')</h1>
            <form class="grid grid-cols-4 gap-x-5 mb-6" method="GET" action="{{ route('experts') }}">
                <input name="search"
                    class="bg-[#EDEDED] py-3 px-2 text-center border border-[#DEDEDE] rounded-md focus:outline-none"
                    type="text" placeholder="{{__('general.experts.filters.name_placeholder')}}" value="{{ request()->query('search') }}">
                <select name="label"
                    class="border border-[#D0D0D0]  rounded-md text-center text-primary px-2  focus:outline-none">
                    <option value="" disabled selected>@lang('general.label')</option>
                    <option value="">@lang('general.none')</option>
                    <option value="epe" @selected(request()->query('label') == 'epe')>@lang('general.EPE')</option>
                    <option value="pv" @selected(request()->query('label') == 'pv')>@lang('general.PV')</option>
                </select>
                <select name="wilaya"
                    class="border border-[#D0D0D0]  rounded-md text-center text-primary px-2  focus:outline-none">
                    <option value="" disabled selected>@lang('general.wilaya')</option>
                    <option value="">@lang('general.none_f')</option>
                    @foreach ($wilayas as $key => $wilaya)
                        <option value="{{ $key }}" @selected(request()->query('wilaya') == $key)>{{ $key }} -
                            {{ $wilaya }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary font-semibold">@lang('general.search')</button>
            </form>
            @if (count($experts))
                <div class="grid grid-cols-6 gap-5">
                    @foreach ($experts as $expert)
                        <div class="p-3 shadow-xl rounded-xl flex flex-col justify-between items-center">
                            <div class="flex gap-4 items-center mb-3.5">
                                <img class="size-16 rounded-full"
                                    src="{{ $expert->getFirstMedia('experts_avatars') ?? asset('images/placeholder.webp') }}">
                                <div class="flex flex-col">
                                    @if ($expert->label == LabelType::PV)
                                        <span class="text-xs text-white rounded p-0.5 bg-[#8DBE22] w-fit">@lang('general.PV')</span>
                                    @else
                                        <span class="text-xs text-white rounded p-0.5 bg-[#FAB513] w-fit">@lang('general.EPE')</span>
                                    @endif
                                    <span class="text-sm font-bold text-primary">{{ $expert->fname }}</span>
                                    <span class="text-sm font-bold text-primary">{{ $expert->lname }}</span>
                                    <span
                                        class="text-xs font-semibold text-[#AFAFAF]">{{ $expert->wilaya ? $expert->wilaya->name : 'Aucune' }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-[#AFAFAF]">@lang('general.experts.experience'):
                                    {{ $expert->years_of_experience ? $expert->years_of_experience . ' ' . __('general.experts.years') : __('general.not_specified') }}
                                </p>
                                <span class="text-xs font-semibold text-[#AFAFAF]">@lang('general.experts.number_of_projects'):
                                    {{ $expert->number_of_projects ?? __('general.not_specified') }} </span>
                                    <a href="{{route('experts.single', ['expert' => $expert])}}" class="btn btn-primary w-full py-2.5 mt-3 text-xs font-bold inline-block text-center">@lang('general.experts.see_profile')</a>
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
