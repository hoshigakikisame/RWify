<div class="card-container px-3 py-4">
    <div class="card-wrap overflow-hidden rounded-xl border dark:border-gray-700">
        <div class="card-img h-[275px] w-full bg-cover bg-center" style="background-image: url({{ $pengumuman->getImageUrl() }})">
            <div class="h-full w-full backdrop-brightness-50 dark:backdrop-brightness-75"></div>
        </div>
        <div class="card-body mx-6 my-5 flex flex-col gap-2 h-48 mb-4">
            <h5 class="text-xs dark:text-gray-600">{{ $pengumuman->diperbarui_pada->diffForHumans() }}</h5>
            <h2 class="text-lg font-medium leading-6 line-clamp-2 h-12">{{ $pengumuman->getJudul() }}</h2>
            <p class="dark:text-gray-500 line-clamp-3">{{ $pengumuman->getKonten() }}</p>
            <div class="action-button mt-auto text-green-700">
                <a href="{{ route('informasi.pengumuman.detail', [$pengumuman->getIdPengumuman()]) }}" target="_blank" class="flex items-center ">
                    <span class="py-2 dark:text-green-500 text-sm text-green-700">Selengkapnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 pt-1 text-green-700" fill="green">
                        <path d="M18 12a2 2 0 0 0-.59-1.4l-4.29-4.3a1 1 0 0 0-1.41 0 1 1 0 0 0 0 1.42L15 11H5a1 1 0 0 0 0 2h10l-3.29 3.29a1 1 0 0 0 1.41 1.42l4.29-4.3A2 2 0 0 0 18 12"/>
                    </svg>
                </a>                
            </div>
        </div>
    </div>
</div>
