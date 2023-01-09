<!DOCTYPE html>
<html lang="en">
@include('includes.main.header')
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    @include('includes.main.sidebar')
    @yield('content')
</div>
@include('includes.main.scripts')
@include('includes.main.footer')
</body>
</html>
