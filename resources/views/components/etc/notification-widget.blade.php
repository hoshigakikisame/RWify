<div class="notification relative" x-data="{ notifDrop: false }">
    <div class="trigger px-5">
        <button
            class="relative hover:bg-gray-200/70 p-4 rounded-full dark:fill-gray-50 transition-all dark:hover:fill-blue-200 dark:hover:bg-gray-700/70 hover:fill-blue-900"
            type="button" @click="notifDrop = !notifDrop">
            <div class="relative ">

                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24"
                    class="w-5 h-5 fill-inherit drop-shadow-xl">
                    <path
                        d="M4.068 18h15.656a3 3 0 0 0 2.821-4.021l-2.852-7.885A8.32 8.32 0 0 0 11.675 0a8.32 8.32 0 0 0-8.123 6.516l-2.35 7.6A3 3 0 0 0 4.068 18M7.1 20a5 5 0 0 0 9.8 0Z" />
                </svg>
                @if ($notifications->count() > 0)
                <span class="absolute top-0">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                    </span>
                </span>
                @endif
            </div>
        </button>
    </div>
    <div id="notif-drop-container"
        class="absolute right-10 bg-gray-50 ring ring-blue-200/40 dark:ring-blue-400/40 dark:bg-darkBg rounded-xl min-w-96 z-30 shadow-lg border border-blue-400 "
        x-cloak x-show="notifDrop" @click.away="notifDrop = false"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="px-5 py-5">
            <div class="header-notif flex justify-between mb-2">
                <div class="wrap-text-header">
                    <h1 class="text-xl font-semibold tracking-wide">Notifikasi</h1>
                    <p class="text-xs text-gray-400 dark:text-gray-500">Anda mempunyai <span class="text-blue-500">5
                            notifikasi</span> baru</p>
                </div>
                <button type="button" class="fill-gray-500 dark:fill-gray-400 self-start" @click="notifDrop = false">
                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24" class="w-5 h-5">
                        <path
                            d="M16.707 8.707 13.414 12l3.293 3.293-1.414 1.414L12 13.414l-3.293 3.293-1.414-1.414L10.586 12 7.293 8.707l1.414-1.414L12 10.586l3.293-3.293zM24 12c0 6.617-5.383 12-12 12S0 18.617 0 12 5.383 0 12 0s12 5.383 12 12m-2 0c0-5.514-4.486-10-10-10S2 6.486 2 12s4.486 10 10 10 10-4.486 10-10" />
                    </svg>
                </button>
            </div>

            <ul class="body-wrap">
                @foreach ($notifications as $notification)
                    <li id="notification-item-{{ $notification->id_notification }}" class="cursor-pointer">
                        <a type="button" onclick="markAsRead({{ $notification->id_notification }});visitNotificationUrl('{{ $notification->slug }}')"
                            class="hover:bg-gray-100 dark:hover:bg-gray-800 flex justify-between items-center py-2 pb-3 px-1 rounded-t-md">
                            <div class="wrap-text">
                                <p class="text-xs text-gray-900 dark:text-gray-300">{{ $notification->pesan }}</p>
                            </div>
                            <div class="action flex gap-2">
                                <button id="close-{{ $notification->id_notification }}" type="button"
                                    onclick="markAsRead({{ $notification->id_notification }})"
                                    class="bg-gray-100 dark:hover:bg-gray-700 hover:bg-gray-200 dark:bg-darkBg p-2 fill-red-500 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4">
                                        <path
                                            d="M18 6a1 1 0 0 0-1.414 0L12 10.586 7.414 6A1 1 0 0 0 6 6a1 1 0 0 0 0 1.414L10.586 12 6 16.586A1 1 0 0 0 6 18a1 1 0 0 0 1.414 0L12 13.414 16.586 18A1 1 0 0 0 18 18a1 1 0 0 0 0-1.414L13.414 12 18 7.414A1 1 0 0 0 18 6" />
                                    </svg>
                                </button>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>


        </div>
    </div>

</div>
<script>

    function visitNotificationUrl(slug) {
        window.open(slug, '_blank');
    }

    function markAsRead(idNotification) {

        document.querySelector(`#notification-item-${idNotification}`).remove();

        fetch('{{ route('user.notification.markAsRead') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id_notification: idNotification
            })
        }).then(response => {
            console.log(response);
        }).catch(error => {
            console.error(error);
        });
    }
</script>
