<div class="flash-message ">
    @foreach (['danger' => ['text-color'=>'rose-700', 'bg-color'=>'rose-200'], 'warning' => ['text-color'=>'yellow-700', 'bg-color'=>'yellow-200'], 'success' => ['text-color'=>'green-700', 'bg-color'=>'green-200'], 'info' => ['text-color'=>'blue-700', 'bg-color'=>'blue-200']] as $msg => $msg_style)
    @if (Session::has($msg))
    <div class="bg-{{$msg_style['bg-color']}} w-full h-full px-5 py-3">
        <p class="text-{{ $msg_style['text-color']}} font-Inter font-semibold">{{ Session::get($msg) }}</p>
    </div>
    @endif
    @endforeach
</div>