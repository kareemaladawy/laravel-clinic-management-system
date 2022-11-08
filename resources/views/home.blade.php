<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body>
    @auth()
    <img src="{{auth()->user()->attachment()->first()->url}}"/>
    @endauth
</body>
</html>
