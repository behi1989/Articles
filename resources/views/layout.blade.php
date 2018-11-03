<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('csrf')
    @yield('title')

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    @yield('styles')
</head>

<body>

    @include('layouts.navbar')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            @yield('content')

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>

    </div>
    <!-- /.row -->

    <hr>


</div>

    <!-- Footer -->
    @include('layouts.footer')

<!-- /.container -->

<!-- jQuery -->
    @include('layouts.footer-script')
    @yield('scripts')
</body>

</html>
