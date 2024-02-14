@extends('layouts.auth')

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
                <div class="col-md-5 login_form_block">
                   <div class="qf-users-container">
                   <a href="{{url('admin-login')}}" class="users-wrapper">
                        <div class="user-inner">
                            <div class="logo">
                                <img  src="./assets/img/forex_new/admin-icon.png" alt="admin" class="logo-icon">
                            </div>
                            <span class="qf-text-black">
                                Admin
                            </span>
                        </div>
                    </a>
                    <a href="{{url('/branch-login')}}" class="users-wrapper">
                        <div class="user-inner">
                            <div class="logo">
                                <img  src="./assets/img/forex_new/client-icon.png" alt="client" class="logo-icon">
                            </div>
                            <span class="qf-text-black">
                                Branch
                            </span>
                        </div>
                    </a>
                   </div>
            </div>
        </div>
      
    </section>
@endsection

