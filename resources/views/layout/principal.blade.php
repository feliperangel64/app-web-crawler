<!DOCTYPE html>
<html>
    <head>
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/custom.css" rel="stylesheet">
        <title>Veículos - Seminovos BH</title>
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-default">
                <div class="container-fluid">

                    <div class="navbar-header">      
                        <a class="navbar-brand" href="/carros">Veículos - Seminovos BH</a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="/auth/login">Login</a></li>
                        <li><a href="/auth/register">Cadastre-se</a></li>
                        @else
                        <li><a href="#">Bem vindo, {{ucfirst(Auth::user()->name)}}!</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                        @endif
                    </ul>                    

                </div>
            </nav>

            @yield('conteudo')

            <footer class="footer">
                <p>© Seminovo BH</p>
            </footer>

        </div>
    </body>
</html>