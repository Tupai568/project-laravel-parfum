<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ $judul }}</title>
        <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/style.css'); }}" />
    </head>
    <body>
        <header class="header">
            <i class="fa-solid fa-list" id="menu"></i>
            <div class="logo">
                <h1 class="textLogo">AMBERGEIS</h1>
                <nav>
                    <ul>
                        <li
                            class="{{
                                $judul === 'Home' || $judul == 'dashboard'
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <a href="/">Home</a>
                        </li>
                        <!-- Buat Can Admin Di AppProviders -->
                        @can('admin')
                        <li
                            class="{{
                                $judul === 'dashboardAdmin' ||
                                $judul === 'dashboardAdminShow' ||
                                $judul === 'dashboardAdminCreate' ||
                                $judul === 'dashboardAdminEdit'
                                    ? 'active'
                                    : ''
                            }}"
                        >
                            <a href="/dashboard/admin/posts">Admin</a>
                        </li>
                        @endcan
                        <div class="dropdown">
                            <button class="selectDropDown">
                                Categories
                                <i
                                    class="fa-solid fa-caret-down"
                                    style="font-size: 0.7em"
                                    id="down"
                                ></i>
                            </button>
                            <!-- active dropdown -->
                            <div class="activeDropDown">
                                <ul>
                                    @foreach ($categories as $category)
                                    <a href="/category/{{ $category->name }}"
                                        ><li
                                            class="{{ ($judul ===  $category->name )? 'active':'' }}"
                                        >
                                            {{ $category->name }}
                                        </li></a
                                    >
                                    @endforeach
                                    <span></span>
                                    <a href="/category"
                                        ><li
                                            class="{{
                                                $judul === 'everything'
                                                    ? 'active'
                                                    : ''
                                            }}"
                                        >
                                            everything
                                        </li></a
                                    >
                                </ul>
                            </div>
                            <!-- end Active dropdown -->
                        </div>
                    </ul>
                </nav>
            </div>
            <div class="container-icons">
                @if($judul !== 'dashboardAdminShow' && $judul !==
                'dashboardAdminEdit' && $judul !== 'dashboardAdminCreate')
                <i class="fa-solid fa-magnifying-glass" id="search"></i>
                @endif
                <div class="box-icons">
                    @auth
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="keluar">
                            <i class="fa-solid fa-reply-all"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                    @else
                    <div class="log-icons">
                        <i class="fa-solid fa-right-to-bracket" id="login"></i>
                        <span>Login</span>
                    </div>
                    @endauth
                </div>
            </div>
        </header>

        @yield('container')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('/js/script.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(".like-button").click(function () {
                    var postId = $(this).data("postid");
                    var likeButton = $(this);

                    $.ajax({
                        type: "POST",
                        url: "/like",
                        data: {
                            post_id: postId,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            // Mencari elemen-elemen yang sesuai dengan postingan yang sedang diproses
                            var likeCountElement =
                                likeButton.find(".like-count");
                            likeCountElement.text(response.likeCount);

                            var heartIcon = likeButton.find("i.fa-heart");
                            if (response.status == "liked") {
                                heartIcon.addClass("love");
                            } else {
                                heartIcon.removeClass("love");
                            }
                        },
                    });
                });

                $("#mencari").keyup(function () {
                    let searchTerm = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "/search",
                        data: {
                            search: searchTerm,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (response) {
                            $(".ajax-result").empty();
                            if (searchTerm != "") {
                                if (response.result == "not found") {
                                    $(".ajax-result").append(
                                        "<a><p>" + response.result + "</p></a>"
                                    );
                                } else {
                                    $.each(response, function (index, result) {
                                        $(".ajax-result").append(
                                            '<a href="/detail/' +
                                                result.id +
                                                '"><li>' +
                                                result.judul +
                                                "</li></a>"
                                        );
                                    });
                                }
                            }
                        },
                    });
                });
            });
        </script>
    </body>
</html>
