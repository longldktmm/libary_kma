@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> MƯỢN TÀI LIỆU</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Quản lý mượn trả</a></li>
        <li class="active"> Mượn tài liệu</li>
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
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sách đã mượn</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Mã sách</th>
                                <th> Tên sách</th>
                                <th> Ngày mượn</th>
                                <th> Số ngày mượn</th>
                                <th> Trạng thái lúc mượn</th>
                                <th> Tình trạng</th>
                                <th> Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($borrow as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_code}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->expiry}}</td>
                                <td>{{$row->document_status}}</td>
                                <td>{{$row->booking_status_name}}</td>
                                <td><a href="{{url('admin/borrow/delete')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Xóa</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Mã sách</th>
                                <th> Tên sách</th>
                                <th> Ngày mượn</th>
                                <th> Số ngày mượn</th>
                                <th> Trạng thái lúc mượn</th>
                                <th> Tình trạng</th>
                                <th> Xóa</th>
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