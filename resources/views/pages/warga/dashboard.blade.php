@extends(request()->user()->getSidebarView())
@section('content')
    <section class="relative container mx-auto mb-3 mt-7 px-4 dark:text-gray-300">
        <div class="greeting mb-2 border-b pb-3">
            <h6 class="font-Inter text-indigo-800">Hi {{ auth()->user()->nama_depan }},</h6>
            <h1 class="text-4xl font-semibold text-gray-900">Selamat Datang di RWify</h1>
        </div>
        <div class="datavisual w-fit">
            <div class="header-wrap mb-4">
                <h1 class="font-Montserrat text-lg text-gray-600 font-medium">Calculation</h1>
                <p class="text-xs text-gray-400">berikut merupakan kalkulasi dari seluruh data yang ada</p>
            </div>
            <div class="wrap-card px-2">
                <div
                    class="card bg-white/80 text-gray-600 dark:text-gray-100 ring ring-green-200/20 dark:border-gray-400 border dark:bg-gray-800 px-5 py-4 rounded-lg w-fit">
                    <div class="card-header mb-0.5 flex justify-between">
                        <h1 class="text-xs font-medium tracking-wide">Offers</h1>
                        <div class="icon ">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Isolation Mode" viewBox="0 0 24 24"
                                class="w-5 h-5 fill-green-700 backdrop-filter drop-shadow-md">
                                <path
                                    d="M12 0a12 12 0 1 0 12 12A12.013 12.013 0 0 0 12 0m8.941 11h-3.478a18.4 18.4 0 0 0-2.289-7.411A9.01 9.01 0 0 1 20.941 11M9.685 14h4.63A17 17 0 0 1 12 19.9 16.9 16.9 0 0 1 9.685 14m-.132-3A16.25 16.25 0 0 1 12 4.1a16.24 16.24 0 0 1 2.447 6.9Zm-.727-7.411A18.4 18.4 0 0 0 6.537 11H3.059a9.01 9.01 0 0 1 5.767-7.411M3.232 14h3.409a18.9 18.9 0 0 0 2.185 6.411A9.02 9.02 0 0 1 3.232 14m11.942 6.411A18.9 18.9 0 0 0 17.359 14h3.409a9.02 9.02 0 0 1-5.594 6.411" />
                            </svg>
                        </div>
                    </div>
                    <div class="card-body mb-2">
                        <h3 class="text-3xl font-Montserrat font-semibold tracking-wider text-gray-950 dark:text-gray-50">
                            620
                        </h3>
                    </div>
                    <div class="card-footer">
                        <p class="text-[9px] tracking-wide font-Montserrat">Terakhir diupdate <span
                                class="text-green-600">20
                                menit</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
