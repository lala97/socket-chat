<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bumerang.org | @yield('title')</title>
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
    <link href="{{url('/css/style.css')}}" rel="stylesheet" />
    <link href="{{url('/css/custom-styles.css')}}" rel="stylesheet"/>
</head>

<body>
  <div class="container-fluid">

    <!-- BLADE SEHIFESINDE QOYULMALI -->
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/alfagen')}}">Admin Panel</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
              <a class="btn btn-success" href="{{url('/')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Sayta qayıt</a>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        {{-- <li><a href="{{url('/profil')}}"><i class="fa fa-user fa-fw"></i> Profilim</a>
                        </li> --}}
                        {{-- <li class="divider"></li> --}}
                        <li><a href="{{url('alfagen/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Çıxış</a>
                        </li>
                    </ul>
            </ul>
        </nav>

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="{{url('/alfagen')}}"><i class="fa fa-dashboard"></i> Umumi list</a>
                    </li>


                    <li>
                            <li>
                                <a href="{{url('/Dəstək-list')}}"><i class="fa fa-qrcode"></i>Destek Siyahisi</a>
                            </li>
                            <li>
                                <a href="{{url('/İstək-list')}}"><i class="fa fa-qrcode"></i>Istek Siyahisi</a>
                            </li>
                    </li>
                    {{-- <li>
                        <a href="{{url('userlist')}}"><i class="fa fa-table"></i> User List</a>
                    </li> --}}

                </ul>

            </div>

        </nav>
        <div id="page-wrapper">
            @yield('content')
        </div>

    </div>
</div>
    <script src="{{url('/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{url('/js/vendor/bootstrap.min.js')}}"></script>
</body>
</html>
