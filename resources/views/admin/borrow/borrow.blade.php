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
    <div class="box-body">
        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{$user->avatar}}" alt="User profile picture">

                <h3 class="profile-username text-center">{{$user->username}}</h3>

                <p class="text-muted text-center"> - {{$user->department}} - {{$user->name}} - {{$user->role}} - {{$user->classroom}} - {{$user->course}} - {{$user->address}}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box-body">
            <form action="" enctype="multipart/form-data"  role="form" method="post">
                {{csrf_field()}}
                <div class="form-group uppercase">
                    <label>Mã sách</label>
                    <input id = "input_document_code" name = "input_document_code" value="{{ old('input_document_code') }}" type="text" class="form-control" placeholder="Nhập ...">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Số ngày mượn</label>
                    <input id = "input_expiry" name = "input_expiry" value="{{ old('input_expiry') }}" type="text" class="form-control" placeholder="Nhập ...">
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Mượn</button>
                    <button type="reset" class="btn btn-primary"> Làm lại</button>
                    <a href="{{url('admin/borrow')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
                </div>
            </form>
            <form action="{{url('admin/coming')}}" enctype="multipart/form-data"  role="form" method="get">
                {{csrf_field()}}
                <div class="box-footer">
                    <input id = "input_username" name = "input_username" value="{{$user->username}}" type="hidden" class="form-control">
                    <button type="submit" class="btn btn-primary"> Gói mượn: Đã nhận</button>
                </div>
            </form>
            <form action="{{url('admin/coming')}}" enctype="multipart/form-data"  role="form" method="get">
                {{csrf_field()}}
                <div class="box-footer">
                    <input id = "input_username" name = "input_username" value="{{$user->username}}" type="hidden" class="form-control">
                    <button type="submit" class="btn btn-primary"> Gói mượn: Xóa hết</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
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
                                    <th> Tình trạng hẹn</th>
                                    <th> Mã gói hẹn</th>
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
                                    <td>{{$row->booking_code}}</td>
                                    <td>        
                                        @if($row->booking_status_name == "Chờ đến nhận" 
                                        || $row->booking_status_name == "Ngoại lệ"
                                        )
                                        <form action="{{url('admin/borrow/booking/lend')}}" enctype="multipart/form-data"  role="form" method="post">
                                            {{csrf_field()}}
                                            <input id = "input_borrow_id" name = "input_borrow_id" value="{{$row->id}}" type="hidden" class="form-control">
                                            <button type="submit" class="btn btn-primary" value="submit"> Giao</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>        
                                        @if($row->booking_status_name != "Đã lấy tài liệu") 
                                    <td><a href="{{url('admin/borrow/delete')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Xóa</button></a></td>
                                    @endif
                                    </td>
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
                                    <th> Tình trạng hẹn</th>
                                    <th> Mã gói hẹn</th>
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