@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        TRANG CHỦ
        <small>kmalibrary.vn</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> kmalibrary.vn</a></li>
        <li class="active"> Trang chủ</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <h1>CHÀO MỪNG ĐẾN VỚI TRANG QUẢN TRỊ THƯ VIỆN KMA </h1>
    <h2>Hoạt động gần đây </h2>
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Log:</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Loại hành động</th>
                                <th> Mô trả</th>
                                <th> Từ</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Loại hành động</th>
                                <th> Mô trả</th>
                                <th> Từ</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- DataTables -->
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- page script -->
<script>
                    $(function () {
                        $('#classroom_table').DataTable()
                    })
</script>
<script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML">
</script>
@endsection