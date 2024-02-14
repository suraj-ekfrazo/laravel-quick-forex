@extends('auth::layouts.master')

@section('content')
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                 <div class="col-md-7 p-5 login_bg_block">
					<img src="./assets/img/forex_new/QF-logo.png"
                         style="width:100;" class="img-fluid float-start" alt="Sample image"><div class="clearfix"></div>
					
					<h1 class="float-start mt-5 fw-bold text-white login_text">The World's Largest<br>
						Online Foreign Exchange</h1>
                </div>
                <div class="col-md-5  login_form_block">
                    <form method="POST" action="{{ route('admin-login.login') }}">
                        @csrf
                        
                        <div class="my-4">
                            <p class="text-center fw-bold mx-3 mb-0 fs-2 text-blue">Welcome To QFX Portals</p>
                            <p class="text-center text-muted">Enter your email and password to access Agent panel.</p>
                        </div>
                        <!-- Email input -->
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label class="form-label" style="display:none;">Username</label>
                                <div class="input-group flex-nowrap">
                                    <input type="text" class="form-control border-end-0" placeholder="Enter username" aria-label="Username" aria-describedby="addon-wrapping"
                                    name="user_name"/>
                                    @if ($errors->has('user_name'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('user_name') }}</strong>
                                        </span>
                                    @endif
                                    
                                </div>
                            </div>
                            <!-- Password input -->
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-4 mb-4">
                                <label class="form-label"  style="display:none;">Password</label>
                                <div class="input-group flex-nowrap">
                                    <input type="password" class="form-control border-end-0 " id="password" placeholder="Enter password" aria-label="Password" aria-describedby="addon-wrapping"
                                    name="password"/>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    @if ($errors->has('login-error'))
                                        <span class="invalid-feedback d-block mb-2 text-center" role="alert">
                                        <strong>{{ $errors->first('login-error') }}</strong>
                                    </span>
                                    @endif
                                    <span class="input-group-text bg-transparent border-start-0 login-password" id="addon-wrapping">
                                        <i class="password-eye fas fa-eye-slash"></i>
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                               id="form2Example3"/>
                                        <label class="form-check-label" for="form2Example3">
                                            Remember
                                        </label>
                                    </div>
                                    {{--<a href="#!" class="text-body text-decoration-none"
                                       style="color: #0076BF !important;">Forgot password?</a>--}}
                                </div>
                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button class="btn btn-primary btn-block mb-4  btn-login_new" type="submit">Log in
                                        <img src="./assets/img/login/ic_arrow.svg" class="float-end pt-1" alt="">
                                    </button>
                                    {{--<p class="small fw-bold mt-2 pt-1 mb-0 text-center">No Account ? Go to
                                        <a href="#" style="color: #0076BF !important;" class="text-decoration-none">Sign Up</a></p>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
@endsection
