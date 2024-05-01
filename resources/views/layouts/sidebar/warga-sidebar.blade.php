@extends('layouts.sidebar.sidebar')
@section('menu')
    <x-sidebar.sidebaritem href="{{ route('warga.dashboard') }}" title="Dashboard" :active="request()->routeIs(['warga.dashboard'])">
        <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve" class="lg:w-5 w-6 fill-inherit">
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
            <path
                d="M362.667 383.841v128H448c35.346 0 64-28.654 64-64V253.26a42.67 42.67 0 0 0-12.011-29.696l-181.29-195.99c-31.988-34.61-85.976-36.735-120.586-4.747a85 85 0 0 0-4.747 4.747L12.395 223.5A42.67 42.67 0 0 0 0 253.58v194.261c0 35.346 28.654 64 64 64h85.333v-128c.399-58.172 47.366-105.676 104.073-107.044 58.604-1.414 108.814 46.899 109.261 107.044" />
            <path d="M256 319.841c-35.346 0-64 28.654-64 64v128h128v-128c0-35.346-28.654-64-64-64" />
        </svg>
    </x-sidebar.sidebaritem>
@endsection
