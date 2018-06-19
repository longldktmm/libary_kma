@extends('layouts.admin')
@section('style')
<link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        QUẢN LÝ
        <small> Tài liệu</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Tài liệu</a></li>
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
                    <h3 class="box-title">Danh sách tài liệu</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="classroom_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tác giả</th>
                                <th> Nhà xuất bản</th>
                                <th> Loại</th>
                                <th> Khoa</th>
                                <th> Trạng thái</th>
                                <th> Phiếu mượn</th>
                                <th> Giới thiệu</th>
                                <th> Lần cuối chỉnh sửa</th>
                                <th> Chỉnh sửa</th>
                                <th> Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($document as $row)
                            <tr>
                                <td>{{$i+=1}}</td>
                                <td>{{$row->document_name}}</td>
                                <td>{{$row->author}}</td>
                                <td>{{$row->publishing_company}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{$row->department}}</td>
                                <td>{{$row->status}}</td>
                                <td>{{$row->borrow_by}}</td>
                                <td>{{$row->review}}</td>
                                <td>{{$row->updated_at}}</td> 
                                <td><a href="{{url('admin/document/edit')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Sửa </button></a></td>
                                <td><a href="{{url('admin/document/delete')}}/{{$row->id}}"><button type="submit" class="btn btn-primary"> Xóa</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Stt</th>
                                <th> Tên tài liệu</th>
                                <th> Tác giả</th>
                                <th> Nhà xuất bản</th>
                                <th> Loại</th>
                                <th> Khoa</th>
                                <th> Trạng thái</th>
                                <th> Phiếu mượn</th>
                                <th> Giới thiệu</th>
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
<script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/latest.js?config=TeX-MML-AM_CHTML">
</script>

@endsection