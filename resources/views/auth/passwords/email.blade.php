@extends('auth.main')

@section('title')
<title>Stack Overflow KW | Forgot Password</title>
@endsection

@section('content')
<div class="container">
    <!-- Outer Row -->
    <div class="col-lg-6 col-md-8 mx-auto">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and
                                        we'll send you a link to reset your password!</p>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" aria-describedby="emailHelp" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                placeholder="Enter Email Address...">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </form>
                                </div>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register')}}">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
