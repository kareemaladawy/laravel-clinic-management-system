<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    <img src="{{auth()->user()->attachment()->first()->url}}"/>
    @include('sweetalert::alert')
</body>
</html>
