@extends('layouts.app')

@section('content')
@php
$image = Vite::asset('resources/assets/images/Semeru.png');
@endphp

<div class="overflow-hidden h-screen">
    @include('shared.includes.navbar')
    <div class="grid grid-rows-4 md:grid-rows-3 lg:grid-rows-1 lg:grid-cols-2 h-full">
        <div class="forgotPassword-image relative">
            <div id="sign-image" class="absolute Sign-Image top-0 bottom-0 right-0 left-0 bg-cover " style="background-image: url('{{$image}}')">
                <div class="text-wrap backdrop-brightness-75 dark:backdrop-brightness-90 w-full h-full flex items-center">
                    <h1 class="font-bold font-Poppins text-xl lg:text-6xl 3xl:text-8xl text-white px-7 mx-auto xl:ms-28 lg:block hidden max-w-xl">BUAT RW MENJADI LEBIH EFISIEN DENGAN RWIFY</h1>
                </div>
            </div>
        </div>
        <div class="mt-36 forgotPassword-main">
            <div class="forgotPassword-wrap">
                <div class="forgotPassword-header">
                    <h1 class="text-2xl font-bold">Forgot Password</h1>
                </div>

                <div class="forgotPassword-body ">
                    <form class="form-horizontal" method="POST" action="{{ route('auth.forgotPassword') }}">
                        @csrf
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection