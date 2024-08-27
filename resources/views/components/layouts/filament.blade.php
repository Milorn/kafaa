<!DOCTYPE html>
<html
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])
>
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
                --default-theme-mode: {{ filament()->getDefaultThemeMode()->value }};
            }
        </style>

        @stack('styles')

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const activeSidebarItem = document.querySelector(
                        '.fi-sidebar-item-active',
                    )

                    if (!activeSidebarItem) {
                        return
                    }

                    const sidebarWrapper =
                        document.querySelector('.fi-sidebar-nav')

                    if (!sidebarWrapper) {
                        return
                    }

                    sidebarWrapper.scrollTo(
                        0,
                        activeSidebarItem.offsetTop - window.innerHeight / 2,
                    )
                }, 0)
            })
        </script>

    </head>

    <body
        {{ $attributes
                ->class([
                    'fi-body',
                    'min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white',
                ]) }}
    >

        {{ $slot }}

        @livewire(Filament\Livewire\Notifications::class)

        @filamentScripts(withCore: true)

        @stack('scripts')
    </body>
</html>
