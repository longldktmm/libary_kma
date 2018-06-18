<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller {
    public function index() {
        return view('admin/exam/demo_upload');
    }

    public function doUpload(Request $request) {
        echo 'Up load';
        //Kiểm tra file
        if ($request->hasFile('file_exam')) {
            $file = $request->file_exam;
            //Lấy Tên files
            echo 'Tên Files: ' . $file->getClientOriginalName();
            echo '<br/>';

            //Lấy Đuôi File
            echo 'Đuôi file: ' . $file->getClientOriginalExtension();
            echo '<br/>';

            //Lấy đường dẫn tạm thời của file
            echo 'Đường dẫn tạm: ' . $file->getRealPath();
            echo '<br/>';

            //Lấy kích cỡ của file đơn vị tính theo bytes
            echo 'Kích cỡ file: ' . $file->getSize();
            echo '<br/>';

            //Lấy kiểu file
            echo 'Kiểu files: ' . $file->getMimeType();
            $data = $file->move('upload', $file->getClientOriginalName());
            echo '<br>';
            echo $data;
            //hàm sẽ trả về đường dẫn mới của file trên server
        } else {
            echo '<br>';
            echo 'Không có file';
        }
    }

}
