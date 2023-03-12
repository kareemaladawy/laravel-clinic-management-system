@if($link)
<a href="{{ $link }}">{!! str()->limit($text,30) !!}</a>
@else
{!! $text !!}
@endif