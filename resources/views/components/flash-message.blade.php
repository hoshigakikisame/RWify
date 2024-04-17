<div class="flash-message bg-gray-300">
  @foreach (['danger'=>'red-500', 'warning' =>'yellow-500', 'success' => 'green-500', 'info'=>'blue-500'] as $msg => $msg_type)
  @if(Session::has($msg))
  <p class="text-{{$msg_type}} bg-{{$msg_type}} ">{{ Session::get($msg) }}</p>
  @endphp
  @endif
  @endforeach
</div>