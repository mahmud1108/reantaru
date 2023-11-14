@extends('layout.shop-layout.main')

@section('shop-content')
    <div class="breadcrumb-area common-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap" style="padding: 50px 10px;">
                        <nav aria-label="breadcrumb">
                            <h1>login/register</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('shop-index') }}"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">login/ register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-space pb-0">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-6">

                        @if (session('text'))
                            <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                                <strong>{{ session('text') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4">
                                <ul class="list-disc text-red-500 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $error }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="login-reg-form-wrap">
                            <h2>Sign In</h2>
                            <form action="{{ route('login_act_customer') }}" method="get">
                                @csrf
                                <div class="single-input-item">
                                    <input name="email" type="email" placeholder="Email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="password" placeholder="Enter your Password" required />
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <div class="remember-meta">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                            </div>
                                        </div>
                                        <a href="#" class="forget-pwd">Forget Password?</a>
                                    </div>
                                    <div class="single-input-item">
                                        <button class="btn btn__bg" type="submit">Login</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Login Content End -->

                <!-- Register Content Start -->
                <div class="col-lg-6">

                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc text-red-500 text-sm">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ $error }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('text'))
                        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                            <strong>{{ session('text') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="login-reg-form-wrap sign-up-form">
                        <h2>Singup Form</h2>
                        <form action="{{ route('register_act_customer') }}" method="post">
                            @csrf
                            <div class="single-input-item">
                                <input type="text" placeholder="Full Name" required name="nama"
                                    value="{{ old('nama') }}" />
                            </div>
                            <div class="single-input-item">
                                <input type="email" placeholder="Enter your Email" value="{{ old('email') }}" required
                                    name="email" class="invalid" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" name="password" placeholder="Enter your Password" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" name="password_confirmation"
                                            placeholder="Repeat your Password" required />
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button class="btn btn__bg" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register Content End -->
            </div>
        </div>
    </div>
@endsection
