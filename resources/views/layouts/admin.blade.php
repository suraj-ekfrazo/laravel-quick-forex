<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
    @include('partials.admin-header')
    @include('stacks.css.admin-style')
    @include('stacks.css.datatables')
    @stack('pagestyle')
</head>
<body>
    @include('partials.admin-nav')
    @yield('content')
    @include('partials.footer')
    @include('stacks.js.admin-script')
    @include('stacks.js.datatables')
    @stack('pagescript')
{{--<div class="loading">Loading&#8230;</div>--}}
</body>
</html>



