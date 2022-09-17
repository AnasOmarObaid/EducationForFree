<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf_token" content="{{ csrf_token() }}">
      <title>EducationForFree | {{ $title }}</title>

      <!--bootstrap css-->
      <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">

      <!-- Styles -->
      <link rel="stylesheet" href="{{ mix('css/app.css') }}">

      <!-- vendor css -->
      <link rel="stylesheet" href="{{ asset('front/css/vendor.min.css') }}">

      <!-- Scripts -->
      <script src="{{ mix('js/app.js') }}" defer></script>


      <!-- google fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto:wght@500&display=swap"
            rel="stylesheet">

      <!--- main css --->
      <link rel="stylesheet" href="{{ asset('front/css/main.min.css') }}">
</head>

<body>

      {{ $slot }}

      <!-- jquery file -->
      <script src="{{ asset('front/js/jquery.min.js') }}"></script>

      <script>
            $.ajaxSetup({
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                  }
            });
      </script>

      <!--- popper file -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
      </script>

      <!---bootstrap file-->
      <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

      <!-- vendor file -->
      <script src="{{ asset('front/js/vendor.min.js') }}"></script>

      <!--- main file -->
      <script src="{{ asset('front/js/main.min.js') }}"></script>

      <!-- Scripts -->
      <script src="{{ mix('js/app.js') }}" defer></script>

      <script src="{{ asset('js/playerjs.js') }}"></script>

      @yield('scripts')

</body>

</html>
