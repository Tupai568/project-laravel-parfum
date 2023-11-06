<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $judul }}</title>
    <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/tester.css'); }}">
</head>
<body>
  <header class="header">
    <i class="fa-solid fa-list" id="menu"></i>
    <div class="logo">
      <h1>AMBERGEIS</h1>
      <nav>
        <ul>
          <li><a href="">Home</a></li>
          <div class="dropdown">
            <button class="selectDropDown">Categories
              <i class="fa-solid fa-caret-down" style="font-size: .7em" id="down"></i>
            </button>
            <!-- active dropdown -->
            <div class="activeDropDown">
              <ul>
                <a href=""><li>Unisex</li></a>
                <a href=""><li>Female</li></a>
                <a href=""><li>Male</li></a>
                <span></span>
                <a href=""><li>everything</li></a>
              </ul>
            </div>
            <!-- end Active dropdown -->
          </div>
        </ul>
      </nav>
    </div>
    <div class="container-icons">
      <i class="fa-solid fa-magnifying-glass" id="search"></i>
      <div class="box-icons">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="keluar">
            <i class="fa-solid fa-right-to-bracket" id="login"></i>
          </button>
        </form>
        
      </div>
    </div>
  </header>

  @yield('sidebar')

  <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>