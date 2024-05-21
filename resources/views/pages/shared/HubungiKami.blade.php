{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    @php
        $image = Vite::asset('resources/assets/images/splendid-balaikota.jpg');
    @endphp

    @include('pages.shared.includes.navbar')
    <div class="h-screen overflow-scroll dark:fill-gray-200 dark:text-gray-200">
        <section class="relative mb-10">
            <div class="h-[485px] w-full bg-cover bg-center" style="background-image: url('{{ $image }}')">
                <div class="absolute inset-0 flex flex-col items-center justify-center dark:backdrop-brightness-150">
                    <div
                        class="text-container dark:backdrop-brightness-80 flex h-full w-full flex-col items-center backdrop-brightness-50"
                    >
                        <div class="w-3/4 text-wrap xl:max-w-4xl">
                            <h1
                                class="mb-3 mt-40 whitespace-nowrap text-center font-Poppins text-5xl font-bold text-gray-100"
                            >
                                Hubungi Kami
                            </h1>
                            <h2 class="whitespace-nowrap text-center font-Inter text-xl font-light text-gray-100">
                                Jalin Komunikasi untuk Memperkuat Komunitas
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 flex justify-center">
                <div
                    class="flex h-[385px] w-4/6 translate-y-80 transform overflow-hidden rounded-lg bg-white shadow-lg dark:bg-gray-800"
                >
                    <div class="ml-8 w-2/3 p-8">
                        <h1 class="mb-8 mt-3 font-Poppins text-4xl font-bold text-gray-800 dark:text-gray-200">
                            Kontak Kami
                        </h1>
                        <div class="flex flex-col">
                            <a href="https://wa.me/628123456789" class="flex items-center py-4">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    version="1.1"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    class="mr-8 h-12 w-12"
                                    viewBox="0 0 512 512"
                                    style="enable-background: new 0 0 512 512"
                                    xml:space="preserve"
                                >
                                    <g>
                                        <path
                                            fill="#e5e5e5"
                                            d="M10.895 512A10.895 10.895 0 0 1 .387 498.23l33.285-121.546C12.949 339.21 2.023 296.82 2.039 253.789 2.098 113.848 115.98 0 255.91 0c67.871.027 131.645 26.465 179.578 74.434 47.926 47.972 74.309 111.742 74.29 179.558-.063 139.945-113.946 253.801-253.868 253.801h-.11c-40.87-.016-81.39-9.977-117.468-28.844L13.656 511.645c-.914.238-1.843.355-2.761.355zm0 0"
                                            opacity="1"
                                            data-original="#e5e5e5"
                                            class=""
                                        ></path>
                                        <path
                                            fill="#ffffff"
                                            d="m10.895 501.105 34.468-125.87c-21.261-36.84-32.445-78.63-32.43-121.442C12.989 119.859 121.98 10.895 255.91 10.895c64.992.027 125.996 25.324 171.871 71.238 45.871 45.914 71.125 106.945 71.102 171.855-.059 133.93-109.067 242.91-242.973 242.91-.008 0 .004 0 0 0h-.105c-40.664-.015-80.618-10.214-116.106-29.57zm134.77-77.75 7.378 4.372c31 18.398 66.543 28.128 102.789 28.148h.078c111.305 0 201.899-90.578 201.945-201.902.02-53.95-20.964-104.68-59.093-142.84-38.133-38.16-88.832-59.188-142.778-59.211C144.59 51.922 54 142.488 53.957 253.809c-.016 38.148 10.656 75.296 30.875 107.445l4.805 7.64-20.407 74.5zm0 0"
                                            opacity="1"
                                            data-original="#ffffff"
                                            class=""
                                        ></path>
                                        <path
                                            fill="#64b161"
                                            d="m19.344 492.625 33.277-121.52c-20.531-35.562-31.324-75.91-31.312-117.234.05-129.297 105.273-234.488 234.558-234.488 62.75.027 121.645 24.449 165.922 68.773 44.29 44.324 68.664 103.242 68.64 165.899-.054 129.3-105.28 234.504-234.55 234.504-.012 0 .004 0 0 0h-.106c-39.253-.016-77.828-9.868-112.085-28.54zm0 0"
                                            opacity="1"
                                            data-original="#64b161"
                                            class=""
                                        ></path>
                                        <g fill="#fff">
                                            <path
                                                d="m10.895 501.105 34.468-125.87c-21.261-36.84-32.445-78.63-32.43-121.442C12.989 119.859 121.98 10.895 255.91 10.895c64.992.027 125.996 25.324 171.871 71.238 45.871 45.914 71.125 106.945 71.102 171.855-.059 133.93-109.067 242.91-242.973 242.91-.008 0 .004 0 0 0h-.105c-40.664-.015-80.618-10.214-116.106-29.57zm134.77-77.75 7.378 4.372c31 18.398 66.543 28.128 102.789 28.148h.078c111.305 0 201.899-90.578 201.945-201.902.02-53.95-20.964-104.68-59.093-142.84-38.133-38.16-88.832-59.188-142.778-59.211C144.59 51.922 54 142.488 53.957 253.809c-.016 38.148 10.656 75.296 30.875 107.445l4.805 7.64-20.407 74.5zm0 0"
                                                fill="#ffffff"
                                                opacity="1"
                                                data-original="#ffffff"
                                                class=""
                                            ></path>
                                            <path
                                                fill-rule="evenodd"
                                                d="M195.184 152.246c-4.547-10.11-9.336-10.312-13.664-10.488-3.54-.153-7.59-.145-11.633-.145-4.047 0-10.625 1.524-16.188 7.598-5.566 6.074-21.254 20.762-21.254 50.633 0 29.875 21.758 58.738 24.793 62.793 3.035 4.05 42 67.308 103.707 91.644 51.285 20.227 61.72 16.203 72.852 15.192 11.133-1.012 35.918-14.688 40.976-28.864 5.063-14.175 5.063-26.324 3.543-28.867-1.52-2.527-5.566-4.047-11.636-7.082-6.07-3.035-35.918-17.726-41.485-19.75-5.566-2.027-9.613-3.035-13.66 3.043-4.05 6.07-15.676 19.742-19.219 23.79-3.543 4.058-7.086 4.566-13.156 1.527-6.07-3.043-25.625-9.45-48.82-30.133-18.047-16.09-30.235-35.965-33.777-42.043-3.54-6.07-.06-9.07 2.667-12.387 4.91-5.973 13.149-16.71 15.172-20.758 2.024-4.054 1.012-7.597-.504-10.637-1.52-3.035-13.32-33.058-18.714-45.066zm0 0"
                                                fill="#ffffff"
                                                opacity="1"
                                                data-original="#ffffff"
                                                class=""
                                            ></path>
                                        </g>
                                    </g>
                                </svg>
                                <span class="font-Poppins text-2xl font-medium">+6281-2345-6789</span>
                            </a>
                            <a href="https://www.facebook.com/page" class="mt-0 flex items-center py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-8 h-12 w-12" viewBox="0 0 256 256">
                                    <path
                                        fill="#1877f2"
                                        d="M256 128C256 57.308 198.692 0 128 0C57.308 0 0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445"
                                    />
                                    <path
                                        fill="#fff"
                                        d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A128.959 128.959 0 0 0 128 256a128.9 128.9 0 0 0 20-1.555V165z"
                                    />
                                </svg>
                                <span class="font-Poppins text-2xl font-medium">RW 01 Landungsari</span>
                            </a>
                            <a href="mailto:example@example.com" class="mt-0 flex items-center py-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-8 h-12 w-12" viewBox="0 0 256 193">
                                    <path
                                        fill="#4285f4"
                                        d="M58.182 192.05V93.14L27.507 65.077L0 49.504v125.091c0 9.658 7.825 17.455 17.455 17.455z"
                                    />
                                    <path
                                        fill="#34a853"
                                        d="M197.818 192.05h40.727c9.659 0 17.455-7.826 17.455-17.455V49.505l-31.156 17.837l-27.026 25.798z"
                                    />
                                    <path
                                        fill="#ea4335"
                                        d="m58.182 93.14l-4.174-38.647l4.174-36.989L128 69.868l69.818-52.364l4.669 34.992l-4.669 40.644L128 145.504z"
                                    />
                                    <path
                                        fill="#fbbc04"
                                        d="M197.818 17.504V93.14L256 49.504V26.231c0-21.585-24.64-33.89-41.89-20.945z"
                                    />
                                    <path
                                        fill="#c5221f"
                                        d="m0 49.504l26.759 20.07L58.182 93.14V17.504L41.89 5.286C24.61-7.66 0 4.646 0 26.23z"
                                    />
                                </svg>
                                <span class="font-Poppins text-2xl font-medium">rwsatulds@example.com</span>
                            </a>
                        </div>
                    </div>
                    <div class="w-3/5">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.721303474834!2d112.59123727641754!3d-7.924150871728565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78821f8aeb37cb%3A0x521bf494341a9423!2sLandungsari%20Asri%20Blk.%20A%2014-6%2C%20Dusun%20Rambaan%2C%20Landungsari%2C%20Kec.%20Dau%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur%2065151!5e0!3m2!1sen!2sid!4v1715259121848!5m2!1sen!2sid"
                            width="100%"
                            height="100%"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                </div>
            </div>
        </section>
        <div class="mb-[500px]"></div>
        @include('pages.shared.includes.footer')
    </div>
@endsection
