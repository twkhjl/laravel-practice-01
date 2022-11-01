

<form class="hidden" id="form_redirect" action="{{ route('redirect.flash') }}" method="post">
    @csrf
    <input type="text" name="src" value="{{ $src }}">
    <input type="text" name="to" value="{{ $to }}">
    <button type="submit">submit</button>
</form>
