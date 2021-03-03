<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>


            <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="backend\assets\images\flags\{{Illuminate\Support\Facades\App::currentLocale()}}.png" alt="user-image" height="16">
                </a>
                <div class="dropdown-menu dropdown-menu-right">

                    <!-- item-->
                    <a href="{{ route('lang',['lang' => 'vi']) }}" id="btn-flag-vi" class="dropdown-item">
                        <img src="backend\assets\images\flags\vi.png" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">Vietnamese</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('lang',['lang' => 'en' ]) }}" id="btn-flag-en" class="dropdown-item">
                        <img src="backend\assets\images\flags\en.png" alt="user-image" class="mr-1" height="12">
                        <span class="align-middle">English</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="images/{{Auth::user()->profile_photo_path}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " style="width: 177%">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0"><?php echo __('Welcome') ?>! {{ Auth::user()->name }}</h6>
                    </div>
                      
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                    :active="request()->routeIs('profile.show')">
                                    <i class="fe-user"></i>
                        <span><?php echo __('My profile') ?></span>
                                </x-jet-responsive-nav-link>
                    
                   
                        <form class="mb-2 mt-2" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                <i class="fe-log-out"></i>
                                <span><?php echo __('Logout') ?></span>
                            </x-jet-responsive-nav-link>
                        </form>
                    

                </div>
            </li>
        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="/dashboard" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="backend\assets\images\lg.png" alt="" height="60">
                </span>
                <span class="logo-lg">
                    <img src="backend\assets\images\logo2.png" alt="" height="60">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
