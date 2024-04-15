{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
@include('shared.navbar')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center dark:text-white">Landing Page</h1>
        </div>
    </div>
</div>
@endsection