<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{$title or config('app.name')}} - Controle de Obras</title>

    @section('styles')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
            font-size: 1.7em;
        }
    </style>

    @show

</head>

<body id="app-layout" style="background: #eee;">
    <nav class="navbar nice-bar">
        <div class="container">
            <div class="navbar-header link-bar">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Navegar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                <a href="{{route('home')}}">
                    <img src="{{ URL::asset('img/Sonnitech-logo.png') }}" alt="" style="width: 80px; height: auto;" />
                </a>
                @else
                <a href="{{route('home')}}">
                    <img src="{{ URL::asset('img/Sonnitech-logo.png') }}" alt="" style="width: 80px; height: auto;" />
                </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                {{--<ul class="nav navbar-nav non-button link-bar">--}}
                {{--@if (Auth::guest()) @else--}}
                {{--<li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>--}}
                {{--Home</a></li>--}}
                {{--@endif--}}
                {{--</ul>--}}

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right link-bar non-button">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}" class="">Acessar o Sistema</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-user" aria-hidden=true></span> {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="glyphicon glyphicon-log-out"></i> Sair do Sistema
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li>
                                <a href="{{ url('/change-password') }}">
                                    <i class="glyphicon glyphicon-lock"></i> Alterar Senha
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!--JQuery-->
    {{--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <div class="container body-content">
        @yield('content')
    </div>

</body>

</html>