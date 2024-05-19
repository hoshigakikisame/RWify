{{-- extend to layouts/app --}}
@extends('layouts.app')


{{-- content --}}
@section('content')
<div class="overflow-hidden">
    @include('pages.shared.includes.navbar')
    <div class="dark:text-gray-200 dark:fill-gray-200 overflow-scroll h-screen">
        <section class="px-8 lg:px-16 mb-28">
            <div class="header-section mb-20 text-center max-w-2xl mx-auto">
                <h1 class="text-4xl font-Poppins font-semibold">{{ $pengumumanInstance->getJudul() }}</h1>
            </div>
            <div class="content text-center max-w-5xl mx-auto mb-2">
                <p class="mb-9">{{ $pengumumanInstance->getReadableDibuatPada() }}</p>
            </div>
            <div class="text-center mb-20 max-w-6xl mx-auto">
                <img src="{{ $pengumumanInstance->getImageUrl() }}" class="mx-auto rounded-lg w-full max-h-96 object-cover" style="max-width:75%; height: auto;" alt="Gambar Pengumuman">
            </div>
            <div class="content text-left max-w-5xl mx-auto mb-6">
                <p class="mb-6 text-lg">{{ $pengumumanInstance->getKonten() }}</p>
            </div>
        </section>
        <section class="px-8 lg:px-16 mb-56">
            <div class="header-section mb-10 text-center max-w-2xl mx-auto">
                <h2 class="text-2xl font-Poppins font-semibold">Bagikan Artikel</h2>
            </div>
            <div class="flex justify-center space-x-4">
                <a href="https://wa.me/?text={{ urlencode($pengumumanInstance->getJudul() . ' ' . request()->fullUrl()) }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M19.05 4.91A9.816 9.816 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.264 8.264 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.183 8.183 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07c0 1.22.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28" />
                    </svg> WhatsApp
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.675 0H1.325C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.66-4.788 1.325 0 2.464.099 2.797.143v3.24l-1.92.001c-1.504 0-1.795.714-1.795 1.763v2.312h3.59l-.467 3.622h-3.123V24h6.116c.732 0 1.325-.593 1.325-1.326V1.326C24 .593 23.407 0 22.675 0z" />
                    </svg> Facebook
                </a>
                <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" class="bg-gray-500 text-white px-4 py-2 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M3.9 3.9h6.6V1.5H1.5v9H3.9zm16.2 16.2h-6.6v2.4h9v-9h-2.4zM3.9 3.9h6.6V1.5H1.5v9H3.9zm0 13.2h6.6v-2.4H3.9v6.6h6.6v-2.4H3.9zm13.2 0v6.6h2.4v-9h-2.4z" />
                    </svg> Salin Tautan
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
        navigator.clipboard.writeText(text).then(function() {
            alert('Tautan telah disalin!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endpush