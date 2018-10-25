<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\TblStatistics;
use DB;
use Webpatser\Uuid\Uuid;
use App\TblBorrow;

class Statistics extends Controller {

    public function getAll() {
        $data['statistics'] = TblStatistics::all()->sortByDesc('created_at');
        return view('admin/statistics/all', $data);
    }

    public function refresh() {
        TblStatistics::truncate();
        $sql = 'SELECT 
t1.document_name as ten_sach,tong_so_luong,moi,cu,hong,mat,dang_dat_sach,cho_xac_nhan,da_xac_nhan,xu_ly_sau,dang_muon, tong_so_luong-hong-mat-dang_dat_sach-cho_xac_nhan-da_xac_nhan-xu_ly_sau-dang_muon as so_luong_muon_duoc,t1.type as loai,t1.department as khoa,t1.author as tac_gia
FROM
(SELECT 
document_name,author,type,department,
 sum(case when booking_status=0 then 1 ELSE 0 end) as dang_dat_sach,
  sum(case when booking_status=1 then 1 ELSE 0 end) as cho_xac_nhan,
   sum(case when booking_status=2 then 1 ELSE 0 end) as da_xac_nhan,
      sum(case when booking_status=3 then 1 ELSE 0 end) as xu_ly_sau,
       sum(case when booking_status=5 then 1 ELSE 0 end) as dang_muon
FROM document
LEFT OUTER JOIN  borrow on document.id = borrow.document_code group by document_name,author,type,department) t1
INNER JOIN
(SELECT 
document_name,author,type,department,
count(id) as tong_so_luong,
 sum(case when status="Hỏng" then 1 ELSE 0 end) hong,
  sum(case when status="Cũ" then 1 ELSE 0 end) cu,
   sum(case when status="Mới" then 1 ELSE 0 end) moi,
    sum(case when status="Mất" then 1 ELSE 0 end) mat
FROM document 
group by document_name,author,type,department) t2
on t1.document_name = t2.document_name and t1.author = t2.author  and t1.type = t2.type and t1.department = t2.department ';
        $data = DB::select(DB::raw($sql));
        if ($data == null) {
            return redirect()->route('adminAllStatistics');
        }
        foreach ($data as $item) {
            $inserts[] = [
                'id' => Uuid::generate(4),
                'document_name' => $item->ten_sach,
                'total' => $item->tong_so_luong,
                'new' => $item->moi,
                'old' => $item->cu,
                'broken' => $item->hong,
                'lose' => $item->mat,
                'booking' => $item->dang_dat_sach,
                'waiting' => $item->cho_xac_nhan,
                'verified' => $item->da_xac_nhan,
                'exception' => $item->xu_ly_sau,
                'borrowing' => $item->dang_muon,
                'ready' => $item->so_luong_muon_duoc,
                'type' => $item->loai,
                'department' => $item->khoa,
                'author' => $item->tac_gia,
            ];
        }
        //Thiếu bắt trường hợp ready == 0 thì chuyển sang trang reset ngày
        TblStatistics::insert($inserts);
        return redirect()->route('adminAllStatistics');
    }

    public function endDay() {
        $sql1 = 'UPDATE borrow SET booking_status = 4,note = "Hết giờ làm việc" WHERE booking_status = 1';
        $sql2 = 'DELETE FROM borrow
WHERE booking_status = 0 or (booking_status = 2 and DATEDIFF(booking_time,DATE(NOW()))<= 0)';
        $sql3 = 'UPDATE borrow SET expiry = expiry - 61 WHERE booking_status = 5';
        $data1 = DB::select(DB::raw($sql1));
        $data2 = DB::select(DB::raw($sql2));
        $data3 = DB::select(DB::raw($sql3));
        TblStatistics::truncate();
        $sql = 'SELECT 
t1.document_name as ten_sach,tong_so_luong,moi,cu,hong,mat,dang_dat_sach,cho_xac_nhan,da_xac_nhan,xu_ly_sau,dang_muon, tong_so_luong-hong-mat-dang_dat_sach-cho_xac_nhan-da_xac_nhan-xu_ly_sau-dang_muon as so_luong_muon_duoc,t1.type as loai,t1.department as khoa,t1.author as tac_gia
FROM
(SELECT 
document_name,author,type,department,
 sum(case when booking_status=0 then 1 ELSE 0 end) as dang_dat_sach,
  sum(case when booking_status=1 then 1 ELSE 0 end) as cho_xac_nhan,
   sum(case when booking_status=2 then 1 ELSE 0 end) as da_xac_nhan,
      sum(case when booking_status=3 then 1 ELSE 0 end) as xu_ly_sau,
       sum(case when booking_status=5 then 1 ELSE 0 end) as dang_muon
FROM document
LEFT OUTER JOIN  borrow on document.id = borrow.document_code group by document_name,author,type,department) t1
INNER JOIN
(SELECT 
document_name,author,type,department,
count(id) as tong_so_luong,
 sum(case when status="Hỏng" then 1 ELSE 0 end) hong,
  sum(case when status="Cũ" then 1 ELSE 0 end) cu,
   sum(case when status="Mới" then 1 ELSE 0 end) moi,
    sum(case when status="Mất" then 1 ELSE 0 end) mat
FROM document 
group by document_name,author,type,department) t2
on t1.document_name = t2.document_name and t1.author = t2.author  and t1.type = t2.type and t1.department = t2.department ';
        $data = DB::select(DB::raw($sql));
        if ($data == null) {
            return redirect()->route('adminAllStatistics');
        }
        foreach ($data as $item) {
            $inserts[] = [
                'id' => Uuid::generate(4),
                'document_name' => $item->ten_sach,
                'total' => $item->tong_so_luong,
                'new' => $item->moi,
                'old' => $item->cu,
                'broken' => $item->hong,
                'lose' => $item->mat,
                'booking' => $item->dang_dat_sach,
                'waiting' => $item->cho_xac_nhan,
                'verified' => $item->da_xac_nhan,
                'exception' => $item->xu_ly_sau,
                'borrowing' => $item->dang_muon,
                'ready' => $item->so_luong_muon_duoc,
                'type' => $item->loai,
                'department' => $item->khoa,
                'author' => $item->tac_gia,
            ];
        }
        //Thiếu bắt trường hợp ready == 0 thì chuyển sang trang reset ngày
        TblStatistics::insert($inserts);
        return redirect()->route('adminAllStatistics');
    }

}
