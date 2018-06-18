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
        <li><a href="{{url('/admin/account/all')}}"><i class="fa fa-dashboard"></i> Tài khoản</a></li>
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
    <div class="box-body">
        <form action="" enctype="multipart/form-data"  role="form" method="post" >
            {{csrf_field()}}
            <div class="form-group">
                <div class="form-group uppercase">
                    <label>Mã tài khoản</label>
                    <input id = "input_username" name = "input_username" type="text" class="form-control" value="{{$account->username}}" disabled>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Họ tên</label>
                    <input id = "input_user_name" name = "input_user_name" type="text" class="form-control" value="{{$account->name}}">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Họ tên</label>
                    <input id = "input_user_name" name = "input_classroom" type="text" class="form-control" value="{{$account->classroom}}">
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Quyền</label>
                    <select id = "input_role" name = "input_role" class="form-control">
                        <option value="{{$account->role}}">{{$account->role}}</option>
                        @foreach($role as $row)
                        <option value="{{$row['role_name']}}">{{$row['role_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- select -->
                <div class="form-group">
                    <label>Khoa</label>
                    <select id = "input_department" name = "input_department" class="form-control">
                        <option value="{{$account->department}}">{{$account->department}}</option>
                        @foreach($department as $row)
                        <option value="{{$row['department_name']}}">{{$row['department_name']}}</option>
                        @endforeach
                    </select>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Khóa học</label>
                    <input  id = "input_course" name = "input_course" type="text" class="form-control" value="{{$account->course}}">
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Đường dẫn ảnh đại diện</label>
                    <input  id = "input_avatar" name = "input_avatar" type="text" class="form-control" value="{{$account->avatar}}">
                </div>
                <!-- textarea -->
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea  id = "input_address" name = "input_address" class="form-control" rows="3" >{{$account->address}}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" value="submit"> Sửa</button>
                    <button type="reset" class="btn btn-primary"> Làm lại</button>
                    <a href="{{url('admin/account/all')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
                </div>
        </form>
    </div>
</section>
<!-- /.content -->
@endsection
@section('script')
@endsection