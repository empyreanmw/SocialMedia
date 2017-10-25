
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Blog Template for Bootstrap</title>

  <script type="text/javascript">
    window.App = {!! json_encode([
      'csrfToken' => csrf_token(),
      'user' => Auth::user(),
      ])!!};
    </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
  </head>

  <body>
    <div id="app">
      
      @include('layouts.nav')

      <div  class="container">
        @yield('content')
      </div><!-- /.container -->
      
      @include('layouts.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/dropdown.js') }}"></script>
  </body>
  </html>
