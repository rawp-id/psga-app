@extends('layouts.app')
@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

<div class="container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card borderless shadow" style="border-radius: 15px;">
                {{-- <div class="card-header">
                    Login
                </div> --}}
                <div class="card-body">
                    {{-- <h3>Login</h3> --}}
                    {{--
                    <hr> --}}
                    <p>Silahkan Login Dengan Akun Kampus</p>
                    <a href="{{ url('/auth/google') }}" class="btn btn-outline-primary w-100 mt-3 mb-3" style="border-radius: 12px">
                        <i class="fa-brands fa-google"></i> Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection