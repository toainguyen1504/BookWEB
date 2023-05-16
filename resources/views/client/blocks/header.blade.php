<header class="cuztommize-header header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="{{ !Auth::check() ? route('index') : route('userIndex', ['id' => Auth::user()->id]) }}"
                        class="header__logo">
                        {{-- <img src="{{ asset('viewAssets/img/logo.png') }}" alt=""> --}}
                       <span class="title">SACHVIETNAM</span> 
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">

                        <li class="header__nav-item">
                            <a class="header__nav-link"
                                href="{{ !Auth::check() ? route('index') : route('userIndex', ['id' => Auth::user()->id]) }}">Trang
                                chủ
                            </a>
                        </li>
                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#"
                                role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Thể loại</a>

                            <ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown"
                                aria-labelledby="dropdownMenuMore">

                                @foreach ($data['categories'] as $cate)
                                    <li><a href="#">{{ $cate->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        
                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link header__nav-link--more" href="#"
                                role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="icon ion-ios-more"></i></a>

                            <ul class="dropdown-menu header__dropdown-menu scrollbar-dropdown"
                                aria-labelledby="dropdownMenuMore">

                                <li>
                                    @if (Auth::check() && Auth::user()->level == 1)
                                        <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">Quản lí tài
                                            khoản</a>
                                    @endif
                                </li>

                                <li>
                                    @if (Auth::check() && Auth::user()->level == 0)
                                        <a href="{{ route('admin.dashboard.index') }}" target="_blank">Trang Admin</a>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        <!-- end dropdown -->
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth display_sigin search-container">
                        <form id="my-form" method="GET" action="#" class="header__search">
                            <input type="text" id="search" class="header__search-input" name="search"
                                placeholder="Tìm kiếm sách..." value="">

                            <a id="href-search" href="#">
                                <button id="btn-search" class="header__search-button" type="button">
                                    <i class="icon ion-ios-search"></i>
                                </button>
                            </a>


                            <button class="header__search-close" type="button">
                                <i class="icon ion-md-close"></i>
                            </button>

                        </form>

                        <ul class="list-group">
                            <li id="search-results"></li>
                        </ul>

                        @if (!Auth::check())
                            <a id="custom_display" class="header__sign-in" href="{{ route('templateSignin') }}">
                                <i class="icon ion-ios-log-in"></i>
                                <span>Đăng nhập</span>
                            </a>
                        @elseif (Auth::user()->level == 0)

                            <a id="custom_display" class="header__sign-in" href="{{ route('admin.dashboard.index') }}">
                                <span>Trở về Admin</span>
                            </a>
                        @else
                            <div class="profile__content">
                                <div class="profile__avatar">
                                    <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                        <img src="{{ asset('viewAssets/img/user.svg') }}" alt="">
                                    </a>

                                </div>
                                <div class="profile__user">
                                    <div class="profile__meta">
                                        <a href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                            <h3>{{ Auth::user()->name }}</h3>
                                            <span>
                                                ID:{{ Auth::user()->id }}</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                            <button class="nav-logout" type="button">
                                <a href="{{ route('signout') }}"><i class="icon ion-ios-log-out"></i></a>
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
