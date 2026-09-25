<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', setting('site_name', 'Yakiniku King'))
    </title>

    <meta name="description"
          content="@yield('description', setting('footer_description'))">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    @stack('styles')

</head>

<body>

    @include('fontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('fontend.partials.footer')


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>

</html>