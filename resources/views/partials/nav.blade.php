<!-- Navbar-->

<nav class="navbar navbar-light bg-white">
    <div class="container-fluid">

        <div class="nav-left-in-wrap">
            <button class="burger float-start" onclick="w3_open()"><img src="{{ asset('assets/img/forex_new/icon_menu_burger.svg')}}" style="width:30px;" class="float-start" alt="close">
            </button>
            <div class="date-time-wrap">
                <div class="display-date">
                    <span id="month">month</span>
                    <span id="daynum">00 </span>,
                    <span id="year">0000</span>
                </div>
                <div class="time_border"></div>
                <div class="display-time"></div>
            </div>
        </div>

        <div class="qf-global-search-bar">
            <form action="/action_page.php" class="search-form">
                <input type="text" placeholder="Search.." name="search" class="qf-search-input">
                <button type="submit" class="qf-search-btn"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="dropdown">
            <a class=" text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="text-white">{{Auth::guard('agent_users')->user()->first_name}} {{Auth::guard('agent_users')->user()->last_name}}</span>
                <img src="{{ asset('assets/img/forex_new/icon_user.svg')}}" style="width: 25px;margin-left:15px;" class="me-1" alt="Tridha Patel">
                <a href="javascript:void(0);" data-target="basicSidebar" data-placement="left" data-position="slidepush" is-open="true" is-open-width="1000" class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect pmd-sidebar-toggle">
                    <i class="material-icons md-light"></i>
                </a>
                </span>
            </a>
            <ul class="dropdown-menu" style="min-width:7rem;"aria-labelledby="dropdownMenuLink">
                <li><a href="{{url('/profile')}}" class="dropdown-item" type="button">Profile</a></li>
                <li><a href="{{url('/logout')}}" class="dropdown-item" type="button">Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Navbar -->

<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="close_btn"><img src="{{ asset('assets/img/forex_new/icon_close.svg')}}" class="float-start" style="width:30px;" alt="close"> </button>

  <div class="side-inner d-inline-block h-100 d-flex justify-content-center align-items-center">
        <div class="container side-menu">
            <a href="{{url('dashboard')}}" class="{{ collect(request()->segments())->last() == "transaction" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_transaction.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Transaction">Transaction</a>
            <a href="{{url('/')}}" class="{{ collect(request()->segments())->last() == "summary" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_men_purpose.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Summary">Summary</a>
            <a href="{{url('/')}}" class="{{ collect(request()->segments())->last() == "kyc" ? "active": "" }} w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_source.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Kyc">KYC</a>
            <a href="{{url('/')}}" class="w3-bar-item w3-button"><img src="{{ asset('assets/img/forex_new/icon_menu_report.svg')}}" style="width:25px; margin:0 10px 0 0;" alt="Reports">Reports</a>
        </div>
    </div>
</div>
