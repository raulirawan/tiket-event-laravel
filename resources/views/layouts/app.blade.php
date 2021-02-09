<!DOCTYPE html>
<html lang="en" id="home">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>
    @stack('up-style')
    @include('includes.style')
    @stack('down-style')
  </head>

  <body>
   @include('includes.navbar')

   @yield('content')
    
    @include('includes.footer')

    <!-- Bootstrap core JavaScript -->
    @stack('up-script')
    @include('includes.script')
    @stack('down-script')
    @include('sweetalert::alert')
  </body>
</html>
