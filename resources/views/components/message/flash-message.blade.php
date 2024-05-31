@php
    $styleflash = [
        'danger' => [
            'container-style' => 'bg-rose-50/50 dark:bg-rose-900/50 fill-rose-500 ring-1 ring-rose-400',
            'text-wrap-class' => 'text-rose-800 dark:text-rose-400',
            'text-color' => 'text-rose-600 dark:text-rose-200',
        ],
        'warning' => [
            'container-style' => 'bg-yellow-50/50 dark:bg-yellow-900/50 fill-yellow-500 ring-1 ring-yellow-400',
            'text-wrap-class' => 'text-yellow-800 dark:text-yellow-400',
            'text-color' => 'text-yellow-600 dark:text-yellow-200',
        ],
        'success' => [
            'container-style' => 'bg-green-50/50 dark:bg-green-900/50 fill-green-500 ring-1 ring-green-400',
            'text-wrap-class' => 'text-green-800 dark:text-green-400',
            'text-color' => 'text-green-600 dark:text-green-200',
        ],
        'info' => [
            'container-style' => 'bg-blue-50/50 dark:bg-blue-900/50 fill-blue-500 ring-1 ring-blue-400',
            'text-wrap-class' => 'text-blue-800 dark:text-blue-400',
            'text-color' => 'text-blue-600 dark:text-blue-200',
        ],
    ];
@endphp

<div class="flash-message relative transition-transform">
    @php
        $i = 0;
    @endphp
    @foreach ($styleflash as $msg => $msg_style)
        @if (Session::has($msg))
            <div id="{{ $i }}" class="relative p-3">
                <div
                    class="{{ $msg_style['container-style'] }} flex h-full w-full items-center gap-3 rounded-md px-4 py-2 transition-all">
                    <div class="icon fill-inherit">
                        <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-5">
                            @switch($msg)
                                @case('success')
                                    <path
                                        d="m16.298 8.288 1.404 1.425-5.793 5.707a2 2 0 0 1-2.823-.005l-2.782-2.696 1.393-1.437 2.793 2.707 5.809-5.701ZM24 12c0 6.617-5.383 12-12 12S0 18.617 0 12 5.383 0 12 0s12 5.383 12 12m-2 0c0-5.514-4.486-10-10-10S2 6.486 2 12s4.486 10 10 10 10-4.486 10-10" />
                                @break

                                @case('danger')
                                    <path
                                        d="M23.121 6.151 17.849.878A2.98 2.98 0 0 0 15.728 0H8.273c-.8 0-1.554.312-2.122.879L.879 6.151A2.98 2.98 0 0 0 0 8.272v7.456c0 .801.312 1.554.879 2.121l5.272 5.273A2.98 2.98 0 0 0 8.272 24h7.455c.8 0 1.554-.312 2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121V8.272c0-.801-.313-1.554-.879-2.121ZM22 15.728c0 .263-.106.521-.293.707l-5.271 5.271a1 1 0 0 1-.709.294H8.272a1 1 0 0 1-.708-.293l-5.271-5.272A1 1 0 0 1 2 15.728V8.272c0-.263.106-.521.293-.707l5.27-5.271A1 1 0 0 1 8.272 2h7.455c.267 0 .519.104.708.293l5.271 5.272c.187.187.293.444.293.707v7.456ZM13 13h-2V6h2zm.5 3.5a1.5 1.5 0 1 1-3.001-.001 1.5 1.5 0 0 1 3.001.001" />
                                @break

                                @case('warning')
                                    <path
                                        d="m23.64 18.1-9.4-15.82C13.77 1.48 12.94 1 12 1s-1.77.48-2.23 1.28L.36 18.1c-.47.82-.47 1.79 0 2.6S1.67 22 2.6 22h18.81c.94 0 1.78-.49 2.24-1.3s.46-1.78-.01-2.6m-1.72 1.6c-.05.09-.2.29-.51.29H2.59c-.31 0-.46-.21-.51-.29s-.15-.32 0-.59l9.41-15.82c.15-.26.41-.29.51-.29s.35.03.51.3l9.4 15.82c.16.26.05.5 0 .59ZM11 8h2v6h-2zm0 8h2v2h-2z" />
                                @break

                                @case('info')
                                    <g data-name="01 align center">
                                        <path
                                            d="M12 24a12 12 0 1 1 12-12 12.013 12.013 0 0 1-12 12m0-22a10 10 0 1 0 10 10A10.01 10.01 0 0 0 12 2" />
                                        <path d="M14 19h-2v-7h-2v-2h2a2 2 0 0 1 2 2Z" />
                                        <circle cx="12" cy="6.5" r="1.5" />
                                    </g>
                                @break

                                @default
                            @endswitch
                        </svg>
                    </div>
                    <div class="body-flash flex grow justify-between">
                        <div class="{{ $msg_style['text-wrap-class'] }} text-wrap">
                            <h1 class="{{ $msg_style['text-color'] }} text-md font-medium leading-tight tracking-wide">
                                {{ Session::get($msg)['title'] }}
                            </h1>
                            <p class="text-xs text-inherit">{{ Session::get($msg)['description'] }}</p>
                        </div>
                        <button type="button" onclick="removeFlash('#{{ $i }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill w-4">
                                <path
                                    d="M16 8a1 1 0 0 0-1.414 0L12 10.586 9.414 8A1 1 0 0 0 8 9.414L10.586 12 8 14.586A1 1 0 0 0 9.414 16L12 13.414 14.586 16A1 1 0 0 0 16 14.586L13.414 12 16 9.414A1 1 0 0 0 16 8" />
                                <path
                                    d="M12 0a12 12 0 1 0 12 12A12.013 12.013 0 0 0 12 0m0 22a10 10 0 1 1 10-10 10.01 10.01 0 0 1-10 10" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endif
    @endforeach

    <script>
        function removeFlash(target) {
            $(target).animate({
                top: '-200px'
            }, 'slow', () => {
                $(target).remove();
            });
        }
    </script>
</div>
