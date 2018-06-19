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
        <form action="" enctype="multipart/form-data"  role="form" method="post">
            {{csrf_field()}}
            <div class="form-group uppercase">
                <label>Nhập mã người dùng</label>
                <input id = "input_username" name = "input_username" value="{{ old('input_username') }}" type="text" class="form-control" placeholder="Nhập ...">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" value="submit"> Tiếp tục</button>
                <button type="reset" class="btn btn-primary"> Làm lại</button>
                <a href="{{url('admin')}}"><button type="button" class="btn btn-primary"> Trở về</button></a>
            </div>
        </form>
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