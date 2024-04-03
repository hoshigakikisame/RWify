{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@php
$image = Vite::asset('resources/assets/images/Semeru.png');
$signInElement = Vite::asset('resources/assets/elements/SignInElement.svg');
$googleIcon = Vite::asset('resources/assets/elements/google-icon.svg');
@endphp
<div class="grid grid-rows-4 md:grid-rows-3 lg:grid-rows-1 lg:grid-cols-2 h-screen">
    <div class="Sign-Image flex items-center relative bg-cover" style="background-image: url('{{$image}}')">
        <h1 class="font-bold font-Poppins text-xl lg:text-6xl 3xl:text-8xl text-white ms-28 lg:block hidden max-w-xl">BUAT RW MENJADI LEBIH EFISIEN DENGAN RWIFY</h1>
        <img src="{{$signInElement}}" class="lg:hidden absolute -bottom-1 bg-transparent w-full z-10" alt="data">
    </div>
    <div class="form-login my-auto">
        <div class="container-fluid flex flex-col items-center text-darkLightGrey gap-5 lg:gap-2">
            <div class="signIn-header text-center lg:w-2/3 2xl:w-1/2 md:px-10 flex flex-col gap-2">
                <h1 class=" text-5xl my-4 font-Inter font-bold">Sign In</h1>
                <p class="font-light font-Inter px-16 lg:p-2">Silahkan Sign In Untuk Pengalaman Terhubung yang Lebih Baik</p>
            </div>
            @csrf
            <div class="signIn-body pt-2 md:px-24 w-full p-8 2xl:w-2/3 lg:p-20 2xl:p-5 flex flex-col gap-3">
                <!-- Image Sign -->
                <a class="sso sm:w-full border sm:rounded-md text-center sm:p-2 cursor-pointer flex justify-center gap-3 items-center order-last lg:order-none mb-6 hover:bg-gray-100 transition-all focus:opacity-[0.85] w-fit p-4 rounded-full mx-auto sm:mx-0" href="">
                    <img src="{{$googleIcon}}" alt="Google">
                    <h1 class="hidden lg:block ">Log In dengan Google</h1>
                </a>
                <!-- Devider  -->
                <div class="devide flex justify-between items-center gap-2 sm:gap-7 w-full order-2 lg:order-none mb-2">
                    <div class="line h-[1px] bg-alum grow "></div>
                    <p class="text-[9px] sm:text-xs shrink">Atau Melanjutkan Menggunakan</p>
                    <div class="line h-[1px] grow bg-alum"></div>
                </div>
                <!-- Sign In with Forms -->
                <form action="{{ route('auth.signIn') }}" method="post" class="mb-2">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="font-Inter text-xs text-darkBlue font-normal opacity-70 ">Email</label>
                        <input type=" email" name="email" id="email" class="flex h-12 w-full items-center justify-center rounded-md border p-3 text-sm outline-none border-gray-200" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="font-Inter text-xs text-darkBlue font-normal opacity-70">Password</label>
                        <input type=" password" name="password" id="password" class="flex h-12 w-full items-center justify-center rounded-md border p-3 text-sm outline-none border-gray-200" placeholder="Password">
                    </div>
                    <p class="font-Inter text-xs">Lupa Password Anda? <a href="" class="text-darkGreen">Klik Disini</a></p>
                    <div class="submit-btn" style="margin-top: 20px;">
                        <button type="submit" class="middle none center w-full rounded-md bg-darkGreen py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-darkGreen/20 transition-all hover:shadow-lg hover:shadow-darkGreen/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection