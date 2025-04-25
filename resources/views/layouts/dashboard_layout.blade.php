<!DOCTYPE html>
<html lang="en">

@include('fixed.dashboard.head')

<body>

@include('fixed.dashboard.top_header')
@include('fixed.dashboard.navigation')

@yield('content')

@include('fixed.dashboard.footer')

@include('fixed.dashboard.scripts')
</body>
</html>
