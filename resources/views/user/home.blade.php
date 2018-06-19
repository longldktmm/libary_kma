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
        <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> kmalibrary.vn</a></li>
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
                                <th> Số lượng còn lại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($suggestDocument as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->left}}</td>                      
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Số lượng còn lại</th>
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
@endsection