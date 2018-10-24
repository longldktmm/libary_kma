<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin | KMA LIBRARY</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
        <!-- Morris chart -->
        <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
        <!-- jvectormap -->
        <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @yield('style')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('admin')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>K</b>MA</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>KMA</span>
                </a>
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{url('logout')}}" >
                                    <i class="fa fa-user"></i>
                                    <span class="Button">Đăng xuất</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{Auth::user()->name}}<br>{{Auth::user()->username}}<br>{{Auth::user()->role}}</p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">QUẢN LÝ</li>
                        <li class="treeview">
                            <a href="{{url('admin/document/all')}}">
                                <i class="fa fa-dashboard"></i> <span>Tài liệu</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/document/add')}}"><i class="fa fa-circle-o"></i> Thêm tài liệu</a></li>
                                <li><a href="{{url('admin/document/all')}}"><i class="fa fa-circle-o"></i> Xem | Tìm | Sửa | Xóa</a></li>
                                <li><a href="{{url('admin/document/all')}}"><i class="fa fa-circle-o"></i> Lịch sử</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Quản lý Hẹn Mượn</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/borrow/booking/verify')}}"><i class="fa fa-circle-o"></i> Xác nhận</a></li>
                                <li><a href="{{url('admin/borrow/booking/waiting')}}"><i class="fa fa-circle-o"></i> Đang chờ nhận sách</a></li>
                                <li><a href="{{url('admin/borrow/all')}}"><i class="fa fa-circle-o"></i> Ngoại lệ</a></li>
                                <li><a href="{{url('admin/borrow/all')}}"><i class="fa fa-circle-o"></i> Xem | Chỉnh sửa Tất cả</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Quản lý Mượn trả</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/borrow')}}"><i class="fa fa-circle-o"></i> Mượn</a></li>
                                <li><a href="{{url('admin/reimburse')}}"><i class="fa fa-circle-o"></i> Trả</a></li>
                                <li><a href="{{url('admin/borrow/all')}}"><i class="fa fa-circle-o"></i> Xem | Chỉnh sửa Đã Mượn</a></li>
                                <li><a href="{{url('admin/reimburse/all')}}"><i class="fa fa-circle-o"></i> Xem | Chỉnh sửa Trả</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{url('admin/account/all')}}">
                                <i class="fa fa-share"></i> <span>Quản lý tài khoản</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/account/add')}}"><i class="fa fa-circle-o"></i> Thêm tài khoản</a></li>
                                <!--                                <li class="treeview">
                                                                    <a href="{{url('admin/user/all')}}"><i class="fa fa-circle-o"></i> Xem | Tìm kiếm | Chỉnh sửa 
                                                                    </a>
                                                                    <ul class="treeview-menu">
                                                                        <li><a href="{{url('admin/user/teacher')}}"><i class="fa fa-circle-o"></i> Giáo viên</a></li>
                                                                        <li class="treeview">
                                                                            <a href="{{url('admin/user/student')}}"><i class="fa fa-circle-o"></i> Sinh viên
                                                                                <span class="pull-right-container">
                                                                                    <i class="fa fa-angle-left pull-right"></i>
                                                                                </span>
                                                                            </a>
                                                                            <ul class="treeview-menu">
                                                                                <li><a href="{{url('admin/user/student/ifosec')}}"><i class="fa fa-circle-o"></i> Hệ an toàn</a></li>
                                                                                <li><a href="{{url('admin/user/student/decipher')}}"><i class="fa fa-circle-o"></i> Hệ mật mã</a></li>
                                                                            </ul>
                                                                        </li>
                                                                    </ul>
                                                                </li>-->
                                <li><a href="{{url('admin/account/all')}}"><i class="fa fa-circle-o"></i>  Xem | Tìm | Sửa | Xóa</a></li>
                                <li><a href="{{url('admin/account/history')}}"><i class="fa fa-circle-o"></i> Lịch sử</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{url('admin/coming')}}">
                                <i class="fa fa-files-o"></i>
                                <span>Thống kê</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/statistics/all')}}"><i class="fa fa-circle-o"></i> Xem | Làm mới</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="{{url('admin/coming')}}">
                                <i class="fa fa-files-o"></i>
                                <span>Quản lý Vi phạm</span>
                                <span class="pull-right-container">
                                    <span class="fa fa-angle-left pull-right"></span>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{url('admin/coming')}}"><i class="fa fa-circle-o"></i> Xem | Chỉnh sửa Vi phạm</a></li>
                                <li><a href="{{url('admin/coming')}}"><i class="fa fa-circle-o"></i> Thêm vi phạm</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('/admin/myaccount')}}"><i class="fa fa-book"></i> <span>Tài khoản cá nhân</span></a></li>
                        <li class="header">CHĂM SÓC KHÁCH HÀNG</li>
                        <li><a href="{{url('admin/coming')}}"><i class="fa fa-circle-o text-red"></i> <span>Báo lỗi</span></a></li>
                        <li><a href="{{url('admin/coming')}}"><i class="fa fa-circle-o text-yellow"></i> <span>Nâng cấp</span></a></li>
                        <li><a href="https://drive.google.com/file/d/1nHAvIH6qmkrc7ddRbKZtCGnvBTpE4WvA/view?usp=sharing" target="_blank"><i class="fa fa-circle-o text-aqua"></i> <span>Hướng dẫn sử dụng</span></a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')

            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2018-2018 <a href="http://kmalibary.tk">Thực tập cơ sở Demo</a>.</strong> All rights
                reserved.
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->
                    <!-- Stats tab content -->
                    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
                    <!-- /.tab-pane -->
                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);</script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Morris.js charts -->
        <script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
        <!-- jvectormap -->
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
        <!-- daterangepicker -->
        <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
        <script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('dist/js/demo.js')}}"></script>
        @yield('script')
    </body>
</html>
