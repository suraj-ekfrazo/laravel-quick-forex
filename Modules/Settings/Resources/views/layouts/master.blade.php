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
    @yield('content')

{{-- Laravel Mix - JS File --}}
@include('partials.footer')
@include('stacks.js.script')
</body>
</html>
