<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))
      <p class="alert text-white alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
      @php
        Session::forget('alert-' . $msg);
      @endphp
      @endif
    @endforeach
  </div>