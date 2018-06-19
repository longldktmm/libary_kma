@extends('layouts.user')
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
    <h1>CHÀO MỪNG ĐẾN VỚI THƯ VIỆN KMA </h1>
    <h2>Tài liệu kỳ này </h2>
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách tài liệu nên mượn</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Môn</th>
                                <th> Loại</th>
                                <th> Số lượng còn lại</th>
                                <th> Đối tượng được mượn</th>
                                <th> Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Môn</th>
                                <th> Loại</th>
                                <th> Số lượng còn lại</th>
                                 <th> Đối tượng được mượn</th>
                                <th> Chi tiết</th>
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
@endsection