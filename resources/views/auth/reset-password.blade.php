@extends('layouts.auth')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-6 p-0 ">
                    <img src="{{asset('assets/img/login/login-screen.png')}}"
                         style="height: auto;" class="img-fluid vh-100 d-none d-md-block" alt="Sample image">
                </div>
                <div class="col-md-6">
                    <form method="POST" action="{{ route('reset.password.post') }}">
                        @csrf
                        <div class="text-center">
                            <a href="#" class="mx-1">
                                <img src="{{asset('assets/img/login/logo.png')}}" alt="">
                            </a>
                        </div>
                        <div class="my-4">
                            <p class="text-center   mx-3 mb-0 fs-2">Reset Your Password</p>
                            <p class="text-center text-muted">set your new password.</p>
                        </div>
                        <!-- Email input -->
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                @if (Session::has('message'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                <label class="form-label">New Password</label>
                                <div class="input-group flex-nowrap">
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <input type="password" class="form-control border-end-0" id="password" placeholder="Enter New Password" aria-label="password" aria-describedby="addon-wrapping"
                                           name="password"/>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback d-block mb-2" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <span class="input-group-text bg-transparent border-start-0 login-password"
                                          id="addon-wrapping">
                                        <i class="password-eye fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- Password input -->
                        </div>
                        <div class="row justify-content-center mt-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group flex-nowrap">
                                    <input type="password" class="form-control border-end-0" id="password_confirmation" placeholder="Enter Confirm Password" aria-label="password_confirmation" aria-describedby="addon-wrapping"
                                           name="password_confirmation"/>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback d-block mb-2" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                    <span class="input-group-text bg-transparent border-start-0 reset-password"
                                          id="addon-wrapping">
                                        <i class="reset-password-eye fas fa-eye-slash"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- Password input -->
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-2 mb-2">
                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button class="btn btn-primary btn-block mb-4" type="submit">Set Password
                                        <img src="./assets/img/login/ic_arrow.svg" class="float-end pt-1" alt="">
                                    </button>
                                    <p class="small fw-bold mt-2 pt-1 mb-0 text-center">
                                        <i class="fa-solid fa-angle-left"></i>&nbsp;&nbsp;&nbsp;Back To
                                        <a href="{{route('showLoginForm')}}" style="color: #0076BF !important;" class="text-decoration-none"> Sign In</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-img">
            <img src="./assets/img/login/footer.png" class="img-fluid" alt="">
        </div>
    </section>
@endsection
