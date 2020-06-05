<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- css file  -->
        <link rel="stylesheet" href="/css/app.css" type='text/css'>

        <!-- js file  -->
        <title>@yield('title')</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->

        <!-- Styles -->
    </head>
    <body>
        <div class="container">
        <h1 class="text-center bg-dark text-white p-2">List of Students</h1>    
        
        <br /> 

        <!--main body -->

        @yield('content')

        </div>

        <script src="/js/jquery.js"></script>
        <script>
    </script>
    </body>
</html>
