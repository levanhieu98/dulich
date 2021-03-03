<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
    <div class="h-100" data-simplebar="">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title mt-2"><?php echo __('Menu') ?></li>
                <li>
                    <a href="./dashboard">
                        <i class="fas fa-home"></i>
                        <span> <?php echo __('Dashboard') ?> </span>
                    </a>
                </li>
                <!-- Theo từng quyền -->
                @can('user')
                <li>
                    <a href="#sidebarCrm" data-toggle="collapse">
                        <i class="fas fa-users"></i>
                        <span> <?php echo __('Users') ?> </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('form.user')}}"> <i data-feather="users" style="width: 17px;"></i> <?php echo __('Add_User') ?></a>
                            </li>
                            <li>

                                <a href="{{route('user.index')}}"> <i data-feather="menu" style="width: 17px;"></i> <?php echo __('User') ?></a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('permission.index') }}"> Permissionss</a>
                </li> --}}
                <li>
                    <a href="{{ route('role.index') }}"><i data-feather="tag" style="width: 17px;"></i><?php echo __('Roles') ?></a>
                </li>
            </ul>
        </div>
        </li>
        @endcan
        @can('blog')
        <li>
            <a href="#sidebarTasks" data-toggle="collapse">
                <i class="fas fa-money-check-edit"></i>
                <span> <?php echo __('Manager Blog') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks">
                <ul class="nav-second-level">
                    @can('blog')
                    <li>
                        <a href="./blogs">
                            <i data-feather="book" style="width: 17px;"></i>
                            <span> <?php echo __('Blog') ?> </span>
                        </a>
                    </li>
                    @endcan
                    @can('tag')
                    <li>
                        <a href="./danh-sach-tag">
                            <i data-feather="tag" style="width: 17px;"></i>
                            <span> <?php echo __('Tag') ?> </span>
                        </a>
                    </li>
                    @endcan
                    @can('category')
                    <li>
                        <a href="./danh-sach-the-loai">
                            <i data-feather="bookmark" style="width: 17px;"></i>
                            <span> <?php echo __('Category') ?> </span>
                        </a>
                    </li>
                    @endcan

                    <!-- <li>
                        <a href="./danh-sach-bai-viet-chua-duyet">
                            <i data-feather="layers" style="width: 17px;"></i>
                            <span> <?php echo __('Unapproved Blog') ?> </span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </li>
        @endcan
        @can('tourist')
        <li>
            <a href="#sidebarTasks1" data-toggle="collapse">
                <i class="fas fa-route"></i>
                <span> <?php echo __('Travel') ?> </span>
                <span class="menu-arrow"></span>
            </a>

            <div class="collapse" id="sidebarTasks1">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('tourist.index')}}">
                            <i data-feather="user" style="width: 17px;"></i>
                            <span> <?php echo __('Tourist') ?> </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('tourist.list')}}">
                            <i data-feather="align-justify" style="width: 17px;"></i>
                            <span> <?php echo __('Travel list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @endcan
        <li>
            <a href="#sidebarTasks2" data-toggle="collapse">
                <i class="fas fa-file-signature"></i>
                <span> <?php echo __('Contact') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks2">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('contact.index')}}">
                            <i data-feather="menu" style="width: 17px;"></i>
                            <span> <?php echo __('Contact list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#sidebarTasks3" data-toggle="collapse">
                <i class="fas fa-utensils-alt"></i>
                <span> <?php echo __('where to go to eat') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks3">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('restaurant.index')}}">
                            <i class="fas fa-utensils" style="width: 17px;"></i>
                            <span> <?php echo __('Restaurant list') ?> </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('food.index')}}">
                            <i class="fas fa-cheeseburger" style="width: 17px;"></i>
                            <span> <?php echo __('Food list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- <li>
            <a href="#sidebarTasks4" data-toggle="collapse">
                <i class="fas fa-cheeseburger"></i>
                <span> <?php echo __('Food') ?> </span>
                <span class="menu-arrow"></span>
            </a>

            <div class="collapse" id="sidebarTasks4">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('food.index')}}">
                            <i data-feather="menu" style="width: 17px;"></i>
                            <span> <?php echo __('Food list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>

        </li> -->
        <li>
            <a href="#sidebarTasks5" data-toggle="collapse">
                <i class="fas fa-map-marked"></i>
                <span> <?php echo __('Place') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks5">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('hotel.index')}}">
                        <i class="fas fa-hotel"></i>
                            <span> <?php echo __('Hotel list') ?> </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('place.index')}}">
                        <i class="fas fa-map-marked-alt"></i>
                            <span> <?php echo __('Place list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!-- <li>
            <a href="#sidebarTasks6" data-toggle="collapse">
                <i class="fas fa-map-marked-alt"></i>
                <span> <?php echo __('Place') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks6">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('place.index')}}">
                            <i data-feather="menu" style="width: 17px;"></i>
                            <span> <?php echo __('Place list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li> -->
        <li>
            <a href="#sidebarTasks6" data-toggle="collapse">
                <i class="fas fa-award"></i>
                <span> <?php echo __('Tour operators') ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <div class="collapse" id="sidebarTasks6">
                <ul class="nav-second-level">
                    <li>
                        <a href="{{route('touroperator.index')}}">
                        <i class="fas fa-award"></i>
                            <span> <?php echo __('Tours operators list') ?> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a  href="{{ URL::to('map') }}">
                <i class="fas fa-map-marked"></i>
                <span> <?php echo __('Map') ?> </span>
            </a>
        </li>
        @can('language')
        <li>
            <a href="./danh-sach-ngon-ngu">
                <i class="fas fa-language"></i>
                <span> <?php echo __('Language') ?> </span>
            </a>
        </li>
        @endcan
        </ul>
    </div>
    <!-- End Sidebar -->
    <div class="clearfix"></div>
</div>
<!-- Sidebar -left -->
</div>