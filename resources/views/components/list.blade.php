<div class="paihang">
    <h2 class="ab_title">{{ $title }}</h2>
    <ul>
        @if(!$list->isEmpty())
        @foreach($list as $v)
            <li><b><a href="{{ url('/article/' . $v->id) }}">{{ $v->title }}</a></b>
                {{--<p><i><img src=""></i>...</p>--}}
            </li>
        @endforeach
        @endif
    </ul>
</div>