@extends('layouts.user')
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
        <li><a href="{{url('booking')}}"><i class="fa fa-dashboard"></i> Hẹn mượn sách</a></li>
        <li class="active"> Xem | Hẹn lịch mượn | Hủy</li>
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
    <form action="{{url('borrow/booking')}}" enctype="multipart/form-data"  role="form" method="get">
        {{csrf_field()}}
        <div class="box-footer">
            <button type="submit" class="btn btn-primary" value="submit"> Làm mới</button>
        </div>
    </form>
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách tài liệu</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="document_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tác giả</th>
                                <th> Khoa</th>
                                <th> Loại</th>
                                <th> Có thể cho mượn</th>
                                <th> Ngày mượn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($documentData as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->author}}</td>
                                <td>{{$row->department}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{$row->ready}}</td>
                                <td>
                                    <form action="{{url('borrow/booking/add')}}" method="POST">
                                        {{csrf_field()}}
                                        <input id="input_expiry" type="text" name="input_expiry" value="90"/>
                                        <input id="input_id" type="text" name="input_id" value="{{$row->id}}" hidden="true"/>
                                        <input type="submit" value=" Muốn mượn">
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
                                <th> Có thể cho mượn</th>
                                <th> Ngày mượn</th>
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
                    <h3 class="box-title">Danh sách tài liệu hẹn</h3>
                </div>
                <div class="box-title"> 
                    <form action="{{url('borrow/booking/set-booking-time')}}" enctype="multipart/form-data" method="post">
                        <div class="box-footer">
                            <h4 class="box-title">Chọn ngày nhận sách</h4>
                            {{csrf_field()}}
                            <input type="text" id="input_booking_time" name="input_booking_time" value="">
                            <button type="submit" class="btn btn-primary" value="submit"> Gửi yêu cầu hẹn</button>
                        </div>
                    </form>
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
                                <th> Số ngày mượn còn lại</th>
                                <th> Ngày mượn</th>
                                <th> Gói mượn</th>
                                <th> Ghi chú</th>
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
                                <td>{{$row->booking_code}}</td>
                                <td>{{$row->note}}</td>
                                <td>
                                    @if ($row->booking_status_name == "Bị từ chối" 
                                    || $row->booking_status_name == "Chờ hẹn ngày"
                                    || $row->booking_status_name == "Chờ xử lý"
                                    )
                                    <form action="{{url('borrow/booking/delete')}}" method="POST">
                                        {{csrf_field()}}
                                        <input id="input_document_code" type="text" name="input_document_code" value="{{$row->id}}" hidden="true"/>
                                        <input type="submit" value=" Xóa">
                                    </form>
                                    @endif
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
                                <th> Số ngày mượn còn lại</th>
                                <th> Ngày mượn</th>
                                <th> Gói mượn</th>
                                <th> Ghi chú</th>
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
    format: 'yyyy/mm/dd',
            autoclose: true,
            todayHighlight: true
    });
    });
</script>

@endsection