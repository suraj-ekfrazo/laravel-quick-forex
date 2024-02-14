<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include('partials.admin-header')

       {{-- Laravel Mix - CSS File --}}
        @include('stacks.css.style')
    </head>
    <body>
        @include('partials.admin-nav')
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

        {{-- Laravel Mix - JS File --}}
        @include('partials.footer')
        @include('stacks.js.script')
    </body>
</html>
