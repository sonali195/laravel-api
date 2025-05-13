<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <a href="{{ route('index') }}" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="50"/>
            </span>
            <span class="logo-sm">
                <img src="{{ Helper::assets('assets/images/logo.png') }}" alt="Logo" height="50"/>
            </span>
        </a>
        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about-us') }}"> {{ __('About us') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact-us') }}"> {{ __('Contact') }}</a>
            </li>
            @if (Route::has('blogs'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('blogs') }}"> {{ __('Blogs') }}</a>
            </li>
            @endif
            @if (Route::has('faqs'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('faqs') }}"> {{ __('FAQs') }}</a>
            </li>
            @endif

            @if (Route::has('travelguide'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('travelguide') }}"> {{ __('Travelguide') }}</a>
            </li>
            @endif

            @if (Route::has('schedule'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('schedule') }}"> {{ __('schedule') }}</a>
            </li>
            @endif

            @if (Route::has('liveprogram'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('liveprogram') }}"> {{ __('liveprogram') }}</a>
            </li>
            @endif

            @if (Route::has('nearbyfacility'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('nearbyfacility') }}"> {{ __('Nearby facility') }}</a>
            </li>
            @endif

            @if (Route::has('quran'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('quran') }}"> {{ __('Quran') }}</a>
            </li>
            @endif

            @if (Route::has('assistance_web'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('assistance_web') }}"> {{ __('Assistance web') }}</a>
            </li>
            @endif
        </ul>
        <ul class="navbar-nav flex-row ml-auto d-flex align-items-center list-unstyled topnav-menu float-right mb-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link {{ in_array(Route::currentRouteName(), [ 'login' ]) ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link {{ in_array(Route::currentRouteName(), [ 'register' ]) ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @if($user)
                @if($user->is_active != 0)
                {{-- @php $noti_count = Helper::getNotification(['user_id' => $user->id, 'count' => true, 'status' => 0]) @endphp --}}
                {{-- <li class="dropdown notification-list noti-list">
                    <a class="nav-link dropdown-toggle noti-icon pl-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i data-feather="bell"></i>
                        @if($noti_count > 0)
                        <span class="noti-icon-badge"></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <div class="dropdown-item noti-title border-bottom">
                            <h5 class="font-size-16 m-0">
                                Notifications
                            </h5>
                        </div>
                        <div class="slimscroll noti-scroll noti-body">
                            <a href="javascript:void(0);" class="dropdown-item notify-item border-bottom">
                                <p class="notify-details ml-0">Lorem ipsum dolor sit amet, consetetur ipscing elitr, sed
                                    diam nonumy eirmod.<small class="text-muted opacity8">2 mins ago</small>
                                </p>
                            </a>
                        </div>
                    </div>
                </li> --}}
                @endif
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <div class="media user-profile ">
                            @if($user->photo != "")
                                <img src="{{ $user->photo_url }}" class="avatar-sm rounded-circle" alt="" />
                            @else
                                <span class="image avatar-sm">{{ substr(ucfirst($user->name), 0, 1) }}</span>
                            @endif
                            <div class="media-body text-left">
                                <h6 class="pro-user-name ml-2 my-0">{{ substr(ucfirst($user->name), 0, 15) }}</h6>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down ml-2 align-self-center"><polyline points="4 6 8 10 12 6"></polyline></svg>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item notify-item border-bottom {{ in_array(Route::currentRouteName(),[ 'user.profile' ]) ? 'active' : '' }}" href="{{ route('user.profile') }}">
                            My profile
                        </a>
                        <a class="dropdown-item notify-item border-bottom {{ in_array(Route::currentRouteName(),[ 'user.change.password' ]) ? 'active' : '' }}" href="{{ route('user.change.password') }}">
                            {{ __('Change Password') }}
                        </a>
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
            @endif
        </ul>
    </div>
</div>
