@if(isset($url))
<a href="{{ $url }}">
    <img src="{{ $src }}" style="height: 150px;width:200px"/>
</a>   
@else
<img src="{{ $src }}" style="height: 150px;width:200px"/>
@endif
