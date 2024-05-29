{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    <div class="overflow-hidden">
        @include('pages.shared.includes.navbar')
        <div class="h-screen overflow-scroll dark:fill-gray-200 dark:text-gray-200">
            <section class="mb-28 px-8 lg:px-16">
                <div class="header-section mx-auto mb-20 pt-20 max-w-4xl text-center">
                    <h1 class="font-Poppins text-4xl font-semibold">{{ $pengumumanInstance->getJudul() }}</h1>
                </div>
                <div class="content mx-auto mb-2 max-w-5xl text-center">
                    <p class="mb-4">{{ $pengumumanInstance->getReadableDiperbaruiPada() }}</p>
                </div>
                <div class="mx-auto mb-10 max-w-6xl text-center">
                    <img
                        src="{{ $pengumumanInstance->getImageUrl() }}"
                        class="mx-auto h-2/5 w-3/4 rounded-lg object-cover"
                        alt="Gambar Pengumuman"
                    />
                </div>
                <div class="content mx-auto mb-6 max-w-5xl text-left">
                    <p class="mb-6 text-lg">{{ $pengumumanInstance->getKonten() }}</p>
                </div>
            </section>
            <section class="mb-56 px-8 lg:px-16">
                <div class="header-section mx-auto mb-6 mt-4 max-w-2xl text-center">
                    <h2 class="font-Poppins text-2xl font-semibold">Bagikan Artikel</h2>
                </div>
                <div class="flex justify-center space-x-4">
                    <a
                        href="https://wa.me/?text={{ urlencode($pengumumanInstance->getJudul() . ' ' . request()->fullUrl()) }}"
                        target="_blank"
                        class="flex items-center rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-green-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-7 w-7" viewBox="0 0 24 24">
                            <path
                                fill="currentColor"
                                d="M19.05 4.91A9.816 9.816 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.264 8.264 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.183 8.183 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07c0 1.22.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"
                            />
                        </svg>
                        WhatsApp
                    </a>
                    <a
                        href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        target="_blank"
                        class="flex items-center rounded-lg bg-gray-500 px-4 py-2 text-white hover:bg-sky-700"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-7 w-7" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95"/>
                    </svg>
                        Facebook
                    </a>
                    <button
                        onclick="copyToClipboard('{{ request()->fullUrl() }}')"
                        class="flex items-center rounded-lg bg-gray-500 px-4 py-2 text-white  hover:bg-blue-500"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-7 w-7" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9.172 14.829l5.657-5.657M7.05 11.293l-1.414 1.414a4 4 0 1 0 5.657 5.657l1.412-1.414m-1.413-9.9l1.414-1.414a4 4 0 1 1 5.657 5.657l-1.414 1.414"/>
                    </svg>
                        Salin Tautan
                    </button>
                </div>
            </section>
            @include('pages.shared.includes.footer')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(
                function () {
                    alert('Tautan telah disalin!');
                },
                function (err) {
                    console.error('Could not copy text: ', err);
                },
            );
        }
    </script>
@endpush
