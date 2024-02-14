<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    @include('partials.header')
    @include('stacks.css.style')
    @include('stacks.css.datatables')
    @stack('pagestyle')
</head>
<body>
<div class="loader"></div>
<div id="app">
@include('partials.nav')
	 <audio id="notificationSound" src="{{ asset('assets/Notification.mp3')}}"></audio>
    <div class="container pt-5 pb-5 mt-5 mb-5">
        <!-- Tabs navs -->
        <div class="container mt-5  mb-2">
            <div class="d-flex align-items-center justify-content-end gap-2">
                <div>
                    <img class="mb-2" src="./assets/img/dashboard/svg/ic_calendar.svg" width="20px" alt="">
                    <span class="date"> Date :</span>
                </div>
                <div class="display-date">
                    <span id="daynum">00 </span>/
                    <span id="month">month</span>
                    <span id="year">0000</span>
                </div>
                <div class="time_border">   </div>
                <div> <img class="mb-2" src="./assets/img/dashboard/svg/ic_time.svg" width="25px" alt="">
                    <span class="date"> Time :</span>
                </div>
                <div class="display-time"></div>
            </div>
        </div>
        @yield('content')
    </div>
</div>
@include('partials.footer')
@include('stacks.js.script')
@include('stacks.js.datatables')
@stack('pagescript')
{{--<div class="loading">Loading&#8230;</div>--}}
</body>
</html>
