@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> THỐNG KÊ</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Thống kê</a></li>
        <li class="active"> Xem | Làm mới</li>
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
    <form action="{{url('admin/statistics/refresh')}}" enctype="multipart/form-data"  role="form" method="post">
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
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tổng số lượng</th>
                                <th> Mới</th>
                                <th> Cũ</th>
                                <th> Hỏng</th>
                                <th> Mất</th>
                                <th> Đang đặt sách</th>
                                <th> Đang chờ xử lý</th>
                                <th> Đang chờ đến lấy sách</th>
                                <th> Hẹn hôm khác</th>
                                <th> Đang cho mượn</th>
                                <th> Có thể cho mượn</th>
                                <th> Tác giả</th>
                                <th> Khoa</th>
                                <th> Loại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($statistics as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->total}}</td>
                                <td>{{$row->new}}</td>
                                <td>{{$row->old}}</td>
                                <td>{{$row->broken}}</td>
                                <td>{{$row->lose}}</td>
                                <td>{{$row->booking}}</td>
                                <td>{{$row->waiting}}</td>
                                <td>{{$row->verified}}</td>
                                <td>{{$row->exception}}</td> 
                                <td>{{$row->borrowing}}</td>
                                <td>{{$row->ready}}</td>
                                <td>{{$row->author}}</td>
                                <td>{{$row->department}}</td>
                                <td>{{$row->type}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tổng số lượng</th>
                                <th> Mới</th>
                                <th> Cũ</th>
                                <th> Hỏng</th>
                                <th> Mất</th>
                                <th> Đang đặt sách</th>
                                <th> Đang chờ xử lý</th>
                                <th> Đang chờ đến lấy sách</th>
                                <th> Hẹn hôm khác</th>
                                <th> Đang cho mượn</th>
                                <th> Có thể cho mượn</th>
                                <th> Tác giả</th>
                                <th> Khoa</th>
                                <th> Loại</th>
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