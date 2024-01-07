<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keterlambatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .sidebar {  
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #7FC7D9;
            padding-top: 60px;
            transition: width 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            color: black;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu li a {
            display: block;
            padding: 10px 20px;
            color: black;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .sidebar-menu li a:hover {
            background-color: #7FC7D9;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>
  @if(Auth::check())
  <div class="sidebar">
        <div class="sidebar-header">
            <h5>Rekap Keterlambatan</h5>
        </div>
        <ul class="sidebar-menu">
            <li>
                @if (Auth::user() && Auth::user()->role == 'ps')
                    <a class="nav-link" href="/dashboard2">Dashboard</a>
                @else
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                @endif
            </li>

            @if (Auth::user() && Auth::user()->role == 'admin')
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Data Master</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('rombel.index') }}">Data Rombel</a></li>
                    <li><a class="dropdown-item" href="{{ route('rayon.index') }}">Data Rayon</a></li>
                    @endif
                    <li> @if (Auth::user() && Auth::user()->role == 'ps')
                        <a class="nav-link" href="{{ route('ps.student.index') }}">Data Siswa</a>
                    @else
                        <a class="nav-link" href="{{ route('admin.student.data') }}">Data Siswa</a>
                    @endif </li>
                    @if (Auth::user() && Auth::user()->role == 'admin')
                    <li><a class="dropdown-item" href="{{ route('user.index') }}">Data User</a></li>
                </ul>
            </li>
            @endif

            <li> @if (Auth::user() && Auth::user()->role == 'ps')
                <a class="nav-link" href="{{ route('ps.late.index') }}">Data Keterlambatan</a>
            @else
                <a class="nav-link" href="{{ route('admin.late.data') }}">Data Keterlambatan</a>
            @endif </li>

            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
    @endif  

    <div class="content">
        {{-- Dynamic content that changes on each page, to be filled in the file that extends this template --}}
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</html>