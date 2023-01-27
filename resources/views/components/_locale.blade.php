<form class="container langForm" action="{{route('changeLanguage', $lang)}}" method="POST">
@csrf
<button type="submit" class="m-0 p-0 border-0 bg-CB">
    <img src="{{asset('vendor/blade-flags/language-' . $lang . '.svg')}}" width="32" height="32">
</button>
</form>