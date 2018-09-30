<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test Blog</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css">
</head>
<body>

@include('partials.header')

<main role="main">
    <section class="wrapper">
        <div class="container">

            {{--place "back" button everywhere except index page--}}
            @if (!request()->is('/'))
                <a href="{{ url()->previous() }}" class="btn btn-default btn-link"><i class="fas fa-chevron-left"></i> Back</a>
            @endif

            @yield('content')

        </div>
    </section>
</main>
<footer>
    <script src="{{ mix('/js/app.js') }}"></script>
</footer>
</body>
</html>
