<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ !empty($page_title) ? $page_title : 'DILIMAN COLLAGE GRADING SYSTEM' }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
  <link rel="icon" type="image/png" href="{{ asset('img/dclogo.png') }}">

  <link rel="stylesheet" href="{{ asset('/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body id="page-top" class="print-view {{ !Auth::user() ? 'bg-gradient-primary' : 'loading' }}">

    <div class="print-container">
        @yield('content')
    </div>

<div class="loading-overlay">
    <img src="{{ asset('img/loader.svg') }}">
</div>
  
  <script src="{{ asset('/js/all.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        beforeSend: function(xhr,data) {
            xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            $('body').addClass('loading');
        },
        complete: function(data) {
            if (!data.responseJSON.redirect) {
                $('body').removeClass('loading');
            }
        }
    });
  </script>
  @if(Session::has('message'))
    <script type="text/javascript">
        console.log('{{ Session::get('message') }}');
    </script>
  @endif
  @yield('form-helper-scripts')
  @yield('added-scripts')
</body>
</html>
