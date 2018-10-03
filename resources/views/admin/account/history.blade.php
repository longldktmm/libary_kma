@extends('layouts.admin')
@section('style')
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> Tài khoản</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Tài khoản</a></li>
        <li class="active"> Lịch sử</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <h1>CHÀO MỪNG ĐẾN VỚI TRANG QUẢN TRỊ THƯ VIỆN KMA </h1>
    <h2>Lịch sử thay đổi tài khoản </h2>
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Log:</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="history_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Từ</th>
                                <th> Ngày</th>
                                <th> Mô trả</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($log as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->created_by}}</td>   
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->message}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Từ</th>
                                <th> Ngày</th>
                                <th> Mô trả</th>
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
    $('#history_table').DataTable()
    })
</script>
<script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML">
</script>
@endsection