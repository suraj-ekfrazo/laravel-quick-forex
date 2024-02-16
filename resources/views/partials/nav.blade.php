<!-- Navbar-->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="close_btn"><img src="{{ asset('assets/img/forex_new/icon_close.svg')}}" class="float-start" style="width:30px;" alt="close"> </button>

  <div class="side-inner d-inline-block h-100 d-flex justify-content-center align-items-center">
        <div class="container side-menu">
  <a href="{{route('admin-user.index')}}" class="{{ collect(request()->segments())->last() == "Transactions" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_admin.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Admin">Admin</a>
  <a href="{{route('branch.index')}}" class="{{ collect(request()->segments())->last() == "branch" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_branch.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="branch">Branch</a>
  <a href="{{route('customer.index')}}" class="{{ collect(request()->segments())->last() == "customer" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_customer.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Customer">Customer</a>
  <a href="{{route('agent-transaction.index')}}" class="{{ collect(request()->segments())->last() == "transaction" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_transaction.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Transaction">Transaction</a>
  <a href="{{route('purpose.index')}}" class="{{ collect(request()->segments())->last() == "purpose" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_men_purpose.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Purpose">Purpose</a>
  <a href="{{route('source.index')}}" class="{{ collect(request()->segments())->last() == "source" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_source.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Source">Source</a>
  <a href="{{url('/')}}" class="w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_report.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Reports">Reports</a>
  </div></div>
</div>

<!-- /Navbar -->
<nav class="  navbar p-0 navbar-expand-custom navbar-mainbg fixed-top">


    <div class="container-fluid gap-4">
        <a class="navbar-brand  logo-bg navbar-logo" href="#"><img src="./assets/img/login/logo.png" width="60px" class="img-fluid
            " alt=""></a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class=" collapse justify-content-center gap-4 navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li class="nav-item {{ (Request::is('dashboard') ? 'active' : '') }}">
                    <a class="nav-link" href="{{url('dashboard')}}">
                        <div class="text-center">
                            <i class="fa-solid fa-arrow-right-arrow-left d-none d-md-block mb-2"></i>
                        </div>
                        Transactions</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="javascript:void(0);">
                        <div class="text-center">
                            <i class="fa-solid fa-chart-simple d-none d-md-block mb-2"></i>
                        </div>
                        Summary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        <div class="text-center">
                            <i class="bi bi-clipboard2-data d-none d-md-block "></i>
                        </div>
                        Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        <div class="text-center">
                            <i class="fa-brands fa-searchengin d-none d-md-block mb-2"></i>
                        </div>
                        Agent KYC</a>
                </li>
            </ul>
            </form>

        </div>

        <div class="dropdown  m-auto text-center">
            <a class=" " href="#" role="button" id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="./assets/img/dashboard/profile.png" width="50px" class="avatar img-fluid rounded-circle me-1" alt="Tridha Patel">
                <span class="text-white">{{Auth::guard('agent_users')->user()->first_name}} {{Auth::guard('agent_users')->user()->last_name}}</span>
                <span style="color:  rgba(0,0,0,0.62) ;">
                      <span>
                          <img src="./assets/img/dashboard/Polygon 36.svg" alt="">
                      </span>
                </span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a href="{{ url('/profile') }}" class="dropdown-item" type="button">Profile</a></li>
                <li><a href="{{url('/logout')}}" class="dropdown-item" type="button">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->
