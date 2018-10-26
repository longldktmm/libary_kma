@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
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
        <li class="active"> Xem hoặc chỉnh sửa</li>
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
                    <h3 class="box-title">Danh sách tài khoản</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tài khoản</th>
                                <th> Tên</th>
                                <th> Quyền</th>
                                <th> Lớp</th>
                                <th> Khóa</th>
                                <th> Khoa</th>
                                <th> Địa chỉ</th>
                                <th> Đường dẫn ảnh đại diện</th>
                                <th> Người tạo</th>
                                <th> Lần cuối chỉnh sửa</th>
                                <th> Chỉnh sửa</th>
                                <th> Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($account as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->username}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->role}}</td>
                                <td>{{$row->classroom}}</td>
                                <td>{{$row->course}}</td>
                                <td>{{$row->department}}</td>
                                <td><div style="max-height: 100px; overflow-y: scroll">{{$row->address}}</div></td>
                                <td><div style="max-height: 100px; overflow-y: scroll">{{$row->avatar}}</div></td>
                                <td>{{$row->created_by}}</td>
                                <td>{{$row->updated_at}}</td> 
                                <td><a href="{{url('admin/account/edit')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Sửa </button></a></td>
                                <td><a href="{{url('admin/account/delete')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Xóa</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tài khoản</th>
                                <th> Tên</th>
                                <th> Quyền</th>
                                <th> Lớp</th>
                                <th> Khóa</th>
                                <th> Khoa</th>
                                <th> Địa chỉ</th>
                                <th> Đường dẫn ảnh đại diện</th>
                                <th> Người tạo</th>
                                <th> Lần cuối chỉnh sửa</th>
                                <th> Chỉnh sửa</th>
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
@endsection