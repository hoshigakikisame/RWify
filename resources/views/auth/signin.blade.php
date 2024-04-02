{{-- extend to layouts/app --}}
@extends('layouts.app')

{{-- content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Sign In Page</h1>
                <form action="{{ route('auth.signin') }}" method="post">
                    @csrf
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection