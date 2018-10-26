@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> HẸN MƯỢN SÁCH</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin/borrow/booking/waiting')}}"><i class="fa fa-dashboard"></i> Hẹn mượn sách</a></li>
        <li class="active">         <a href="{{url('admin/borrow/booking/waiting')}}">Duyệt</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <form action="{{url('admin/borrow/booking/waiting')}}" enctype="multipart/form-data"  role="form" method="get">
        {{csrf_field()}}
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" value="submit"> Làm mới</button>
        </div>
    </form>
    <form action="{{url('admin/coming')}}" enctype="multipart/form-data" method="get">
        <div class="box-footer">
            {{csrf_field()}}
            <input type="text" id="input_booking_time" name="input_booking_time" value="" hidden="true">
            <button type="submit" class="btn btn-primary" value="submit"> Từ chối tất cả</button>
        </div>
    </form>
    <!-- /.row -->
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Người hẹn đầu tiên </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="booking_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tác giả</th>
                                <th> Khoa</th>
                                <th> Loại</th>
                                <th> Trạng thái</th>
                                <th> Số ngày mượn</th>
                                <th> Ngày mượn</th>
                                <th> Mã người dùng</th>
                                <th> Mã gói tài liệu</th>
                                <th> Mã tài liệu đề nghị</th>
                                <th> Phê duyệt</th>
                                <th> Từ chối</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($bookingData as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->author}}</td>
                                <td>{{$row->department}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{$row->booking_status_name}}</td>
                                <td>{{$row->expiry}}</td>
                                <td>{{$row->booking_time}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->booking_code}}</td>
                                <td>{{$row->document_code}}</td>
                                <td>
                                    <form action="{{url('admin/borrow/booking/allow')}}" method="POST">
                                        {{csrf_field()}}
                                        <input id="input_document_code" type="text" name="input_document_code" value="" placeholder="Mã sách"/>
                                        <input id="input_booking_code" type="text" name="input_booking_code" value="{{$row->booking_code}}"placeholder="Mã gói"/>
                                        <input id="input_booking_id" type="text" name="input_booking_id" value="{{$row->id}}" hidden="true"/>
                                        <input type="submit" value=" Đồng ý">
                                    </form>
                                </td>
                                <td>
                                    <form action="{{url('admin/borrow/booking/deny')}}" method="POST">
                                        {{csrf_field()}}
                                        <input id="input_note" type="text" name="input_note" value="" placeholder="Chú thích"/>
                                        <input type="submit" value=" Từ chối">
                                        <input id="input_booking_id" type="text" name="input_booking_id" value="{{$row->id}}" hidden="true"/>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tác giả</th>
                                <th> Khoa</th>
                                <th> Loại</th>
                                <th> Trạng thái</th>
                                <th> Số ngày mượn</th>
                                <th> Ngày mượn</th>
                                <th> Gói mượn</th>
                                <th> Mã gói sách</th>
                                <th> Mã tài liệu đề nghị</th>
                                <th> Phê duyệt</th>
                                <th> Từ chối</th>
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
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tình trạng hẹn của user hiện tại</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="booking_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Mã tài liệu</th>
                                <th> Số ngày mượn</th>
                                <th> Ngày mượn</th>
                                <th> Mã người dùng</th>
                                <th> Mã gói sách</th>
                                <th> Chú thích</th>
                                <th> Trạng thái hẹn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($bookingDataVerify as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_code}}</td>
                                <td>{{$row->expiry}}</td>
                                <td>{{$row->booking_time}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->booking_code}}</td>
                                <td>{{$row->note}}</td>
                                <td>{{$row->booking_status_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Mã tài liệu</th>
                                <th> Số ngày mượn</th>
                                <th> Ngày mượn</th>
                                <th> Mã người dùng</th>
                                <th> Mã gói sách</th>
                                <th> Chú thích</th>
                                <th> Trạng thái hẹn</th>
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
    $('#document_table').DataTable();
    });</script>
<script>
    $(function () {
    $('#booking_table').DataTable();
    });</script>
<script>
    $(function () {
    $('#input_booking_time').datepicker({
    format: 'yy/mm/dd',
            autoclose: true,
            todayHighlight: true
    });
    });
</script>

@endsection