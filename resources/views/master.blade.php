<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blue Bus</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

        <style>
            html, body {
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                margin-top:20px;
                background-color: #fafcff;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        
        <div class="position-ref full-height">
            
            <div class="container">
                <div class="card">
                    <div class="card-body">    
                        <h1>
                            <a href="{{route('home')}}">
                                Bluebus
                            </a>
                        </h1>
                        @if(Session::has('msg'))
                            <p class="alert alert-info">{{ Session::get('msg') }}</p>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
