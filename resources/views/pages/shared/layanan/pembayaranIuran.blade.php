{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    @include('shared.includes.navbar')
    <section>
        <h1 class="dark:text-gray-100">Pembayaran Iuran</h1>
    </section>
@endsection
