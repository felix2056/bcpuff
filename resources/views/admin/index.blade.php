@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="wrapper" style="height: auto; min-height: 100%;">
    <!-- Left side column. contains the logo and sidebar -->
    {{-- <aside class="main-sidebar">
        <!-- sidebar-->
        <section class="sidebar" style="height: auto;">
            <div class="user-profile px-10 py-15">
                <div class="d-flex align-items-center">
                    <div class="image">
                        <img src="{{ Auth::user()->photo_url }}" class="avatar avatar-lg" alt="User Image">
                    </div>
                    <div class="info ml-10">
                        <p class="mb-0">Welcome</p>
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                    </div>
                </div>
            </div>

            <!-- sidebar menu-->
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="active">
                    @if (Auth::user()->isAdmin())
                    <a href="{{ route('admin.index') }}">
                        <i class="ti-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                    @else
                    <a href="{{ route('account.index') }}">
                        <i class="ti-dashboard"></i>
                        <span>Account</span>
                    </a>
                    @endif
                </li>

                <li>
                    <a href="{{ route('index') }}">
                        <i class="ti-home"></i>
                        <span>Home</span>
                    </a>
                </li>

                @if (Auth::user()->isAdmin())
                <li class="header">Admin</li>
                <li>
                    <a href="{{ route('products.index') }}">
                        <i class="ti-alert"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="ti-unlock"></i>
                        <span>Users</span>
                    </a>
                </li>
                @endif

                <li class="header">Account</li>
                <li>
                    <a href="{{ route('orders') }}">
                        <i class="ti-shopping-cart-full"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('checkout') }}">
                        <i class="ti-unlock"></i>
                        <span>Checkout</span>
                    </a>
                </li>

                <li class="header">Pages</li>
                <li>
                    <a href="{{ route('faqs') }}">
                        <i class="ti-files"></i>
                        <span>Faqs</span>
                    </a>
                </li>
            </ul>
        </section>
        <div class="sidebar-footer">
            <!-- item-->
            <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
                aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
            <!-- item-->
            <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                    class="ti-email"></i></a>
            <!-- item-->
            <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                    class="ti-lock"></i></a>
        </div>
    </aside> --}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1021px;">
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box">
                            <ul class="box-controls pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="px-10 pt-5"><i
                                            class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="box-body pt-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="icon bg-primary-light rounded-circle">
                                        <i class="text-primary mr-0 font-size-20 fa fa-paypal"></i>
                                    </div>
                                    <div>
                                        <h3 class="mb-0 font-weight-500">{{ $data['total_products'] }}</h3>
                                        <p class="text-mute mb-0">Total Products</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box">
                            <ul class="box-controls pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="px-10 pt-5"><i
                                            class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="box-body pt-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="icon bg-info-light rounded-circle">
                                        <i class="text-info mr-0 font-size-20 fa fa-users"></i>
                                    </div>
                                    <div>
                                        <h3 class="mb-0 font-weight-500">{{ $data['total_users'] }}</h3>
                                        <p class="text-mute mb-0">Registered Users</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box">
                            <ul class="box-controls pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="px-10 pt-5"><i
                                            class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="box-body pt-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="icon bg-warning-light rounded-circle">
                                        <i class="text-warning mr-0 font-size-20 fa fa-user"></i>
                                    </div>
                                    <div>
                                        <h3 class="mb-0 font-weight-500">{{ $data['total_admins'] }}</h3>
                                        <p class="text-mute mb-0">Total Admins</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="box">
                            <ul class="box-controls pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="px-10 pt-5"><i
                                            class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </li>
                            </ul>
                            <div class="box-body pt-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="icon bg-danger-light rounded-circle">
                                        <i class="text-danger mr-0 font-size-20 fa fa-shopping-cart"></i>
                                    </div>
                                    <div>
                                        <h3 class="mb-0 font-weight-500">{{ $data['total_orders'] }}</h3>
                                        <p class="text-mute mb-0">Total Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="box bg-primary bg-img" style="background-image: url(/admin/images/bg-1.png)">
                            <div class="box-body text-center">
                                <div class="icon rounded-circle w-60 h-60 mx-auto my-40">
                                    <i class="text-white mr-0 font-size-20 fa fa-trophy"></i>
                                </div>
                                <div class="max-w-500 mx-auto">
                                    <h2 class="text-white mb-20 font-weight-500">Welcome {{ Auth::user()->name }},</h2>
                                    <p class="text-white-50 mb-10 font-size-20">You account is ready, you can start
                                        browsing all
                                        products on BCPUFF. Checkout the store</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right d-none d-sm-inline-block">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Purchase Now</a>
                </li>
            </ul>
        </div>
        © 2020 <a href="https://www.multipurposethemes.com/">Multipurpose Themes</a>. All Rights Reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar">

        <div class="rpanel-title"><span class="pull-right btn btn-circle btn-danger"><i class="ion ion-close text-white"
                    data-toggle="control-sidebar"></i></span> </div>
        <!-- Create the tabs -->
        <ul class="nav nav-tabs control-sidebar-tabs">
            <li class="nav-item"><a href="#control-sidebar-theme-demo-options-tab" class="active" data-toggle="tab"
                    title="Setting"><i class="mdi mdi-settings"></i></a></li>
            <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab"><i
                        class="mdi mdi-message-text"></i></a></li>
            <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i
                        class="mdi mdi-playlist-check"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <div class="flexbox">
                    <a href="javascript:void(0)" class="text-grey">
                        <i class="ti-more"></i>
                    </a>
                    <p>Users</p>
                    <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
                </div>
                <div class="lookup lookup-sm lookup-right d-none d-lg-block">
                    <input type="text" name="s" placeholder="Search" class="w-p100">
                </div>
                <div class="media-list media-list-hover mt-20">
                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-success" href="#">
                            <img src="../images/avatar/1.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Tyler</strong></a>
                            </p>
                            <p>Praesent tristique diam...</p>
                            <span>Just now</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-danger" href="#">
                            <img src="../images/avatar/2.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Luke</strong></a>
                            </p>
                            <p>Cras tempor diam ...</p>
                            <span>33 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-warning" href="#">
                            <img src="../images/avatar/3.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-primary" href="#">
                            <img src="../images/avatar/4.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-success" href="#">
                            <img src="../images/avatar/1.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Tyler</strong></a>
                            </p>
                            <p>Praesent tristique diam...</p>
                            <span>Just now</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-danger" href="#">
                            <img src="../images/avatar/2.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Luke</strong></a>
                            </p>
                            <p>Cras tempor diam ...</p>
                            <span>33 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-warning" href="#">
                            <img src="../images/avatar/3.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                    <div class="media py-10 px-0">
                        <a class="avatar avatar-lg status-primary" href="#">
                            <img src="../images/avatar/4.jpg" alt="...">
                        </a>
                        <div class="media-body">
                            <p class="font-size-16">
                                <a class="hover-primary" href="#"><strong>Evan</strong></a>
                            </p>
                            <p>In posuere tortor vel...</p>
                            <span>42 min ago</span>
                        </div>
                    </div>

                </div>

            </div>
            <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active">
                <div>
                    <h4 class="control-sidebar-heading p-0"></h4>
                    <div class="flexbox mb-10 pb-10 bb-1 light-on-off"><label for="toggle_left_sidebar_skin"
                            class="control-sidebar-subheading">Dark or Light Skin</label><label class="switch"><input
                                type="checkbox" data-mainsidebarskin="toggle" id="toggle_left_sidebar_skin"><span
                                class="switch-on font-size-30"><i class="mdi mdi-lightbulb-on"></i></span><span
                                class="switch-off font-size-30"><i class="mdi mdi-lightbulb"></i></span></label></div>
                    <h4 class="control-sidebar-heading p-0"></h4>
                    <div class="flexbox mb-10 pb-10 bb-1"><label for="rtl" class="control-sidebar-subheading">Turn
                            RTL/LTR</label><label class="switch switch-border switch-danger"><input type="checkbox"
                                data-layout="rtl" id="rtl"><span class="switch-indicator"></span><span
                                class="switch-description"></span></label></div>
                    <h4 class="control-sidebar-heading p-0"></h4>
                    <div class="flexbox mb-10"><label for="toggle_sidebar" class="control-sidebar-subheading">Toggle
                            Sidebar</label><label class="switch switch-border switch-danger"><input type="checkbox"
                                data-layout="sidebar-collapse" id="toggle_sidebar"><span
                                class="switch-indicator"></span><span class="switch-description"></span></label>
                    </div>
                    <div class="flexbox mb-10"><label for="toggle_right_sidebar"
                            class="control-sidebar-subheading">Toggle Right Sidebar Slide</label><label
                            class="switch switch-border switch-danger"><input type="checkbox"
                                data-controlsidebar="control-sidebar-open" id="toggle_right_sidebar"><span
                                class="switch-indicator"></span><span class="switch-description"></span></label>
                    </div>
                    <h4 class="control-sidebar-heading">Skin Colors</h4>
                    <ul class="list-unstyled clearfix theme-switch">
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-primary"
                                style="background: #5A8DEE; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme primary"></a></li>
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-secondary"
                                style="background: #475F7B; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme secondary"></a></li>
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-info"
                                style="background: #00CFDD; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme info"></a></li>
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-success"
                                style="background: #39DA8A; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme success"></a></li>
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-danger"
                                style="background: #FF5B5C; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme danger"></a></li>
                        <li style="padding: 5px;"><a href="javascript:void(0)" data-theme="theme-warning"
                                style="background: #FDAC41; display: block;vertical-align: middle;"
                                class="clearfix rounded w-p100 h-30 mb-5" title="Theme warning"></a></li>
                    </ul>
                </div>
            </div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <div class="flexbox">
                    <a href="javascript:void(0)" class="text-grey">
                        <i class="ti-more"></i>
                    </a>
                    <p>Todo List</p>
                    <a href="javascript:void(0)" class="text-right text-grey"><i class="ti-plus"></i></a>
                </div>
                <ul class="todo-list mt-20">
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_1" class="filled-in">
                        <label for="basic_checkbox_1" class="mb-0 h-15"></label>
                        <!-- todo text -->
                        <span class="text-line">Nulla vitae purus</span>
                        <!-- Emphasis label -->
                        <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_2" class="filled-in">
                        <label for="basic_checkbox_2" class="mb-0 h-15"></label>
                        <span class="text-line">Phasellus interdum</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_3" class="filled-in">
                        <label for="basic_checkbox_3" class="mb-0 h-15"></label>
                        <span class="text-line">Quisque sodales</span>
                        <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_4" class="filled-in">
                        <label for="basic_checkbox_4" class="mb-0 h-15"></label>
                        <span class="text-line">Proin nec mi porta</span>
                        <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_5" class="filled-in">
                        <label for="basic_checkbox_5" class="mb-0 h-15"></label>
                        <span class="text-line">Maecenas scelerisque</span>
                        <small class="badge bg-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_6" class="filled-in">
                        <label for="basic_checkbox_6" class="mb-0 h-15"></label>
                        <span class="text-line">Vivamus nec orci</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 1 month</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_7" class="filled-in">
                        <label for="basic_checkbox_7" class="mb-0 h-15"></label>
                        <!-- todo text -->
                        <span class="text-line">Nulla vitae purus</span>
                        <!-- Emphasis label -->
                        <small class="badge bg-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_8" class="filled-in">
                        <label for="basic_checkbox_8" class="mb-0 h-15"></label>
                        <span class="text-line">Phasellus interdum</span>
                        <small class="badge bg-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5 by-1">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_9" class="filled-in">
                        <label for="basic_checkbox_9" class="mb-0 h-15"></label>
                        <span class="text-line">Quisque sodales</span>
                        <small class="badge bg-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                    <li class="py-15 px-5">
                        <!-- checkbox -->
                        <input type="checkbox" id="basic_checkbox_10" class="filled-in">
                        <label for="basic_checkbox_10" class="mb-0 h-15"></label>
                        <span class="text-line">Proin nec mi porta</span>
                        <small class="badge bg-success"><i class="fa fa-clock-o"></i> 3 days</small>
                        <div class="tools">
                            <i class="fa fa-edit"></i>
                            <i class="fa fa-trash-o"></i>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('admin/js/pages/dashboard3.js') }}"></script>
@endsection