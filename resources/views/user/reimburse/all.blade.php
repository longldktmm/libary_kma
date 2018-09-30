@extends('layouts.user')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý
        <small> TRẢ TÀI LIỆU CỦA TÔI</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active"> Trả tài liệu</li>
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
    <!-- /.box -->
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sách đã trả</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="reimburse_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Mã sách</th>
                                <th> Tên sách</th>
                                <th> Ngày trả</th>
                                <th> Trạng thái sách lúc trả</th>
                                <th> Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($reimburse as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_code}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->document_status}}</td>
                                 <td>{{$row->commit}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Mã sách</th>
                                <th> Tên sách</th>
                                <th> Ngày trả</th>
                                <th> Trạng thái sách lúc trả</th>
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
    $('#reimburse_table').DataTable()
    })
</script>
@endsection