<!DOCTYPE html>
<html lang="en" dir="{{ LaravelLocalization::getCurrentLocale() == 'ar' && !request()->routeIs('register-page') ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kafaa @isset($title) - {{$title}} @endisset</title>
    @vite('resources/css/app.css')
    @isset($head)
    {{$head}}
    @endisset
</head>
<body>
    <x-ui.header/>
    @isset($main)
    {{$main}}
    @endisset
    @isset($end)
    {{$end}}
    @endisset
    <x-ui.footer/>
</body>
</html>