<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use App\TblStatistics;
use App\TblBorrow;
use Webpatser\Uuid\Uuid;
use App\TblDocument;
use App\TblLog;

class Borrow extends Controller {

    public function getAll() {
        $username = Auth::user()->username;
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
        $data['borrow'] = DB::table('borrow')
                ->where('username', $username)
                ->join('document', 'borrow.document_code', '=', 'document.id')
                ->get();
        return view('user/borrow/all', $data);
    }

    public function bookingGetHome() {
        $data['documentData'] = TblStatistics::all()->sortByDesc('created_at');
        $data['bookingData'] = DB::table('borrow')
                ->where('username', Auth::user()->username)
                ->leftJoin('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                ->leftJoin('document', 'borrow.document_code', '=', 'document.id')
                ->get();
        return view('user/borrow/booking/all', $data);
    }

    public function bookingPostAdd(Request $request) {
        $rules = [
            'input_expiry' => 'numeric | min:7|max:100',
            'input_id' => 'required| string| max: 36| exists:statistics,id',
        ];
        $messages = [
            'input_expiry.numeric' => 'Error 10: Số ngày mượn phải là số',
            'input_expiry.max' => 'Error 11: Mượn tối đa 100 ngày',
            'input_expiry.min' => 'Error 12: Mượn ít nhất 7 ngày',
            'input_id.required' => 'Error 13: Mã tài liệu không được để trống',
            'input_id.max' => 'Error 14: Mã tài liệu quá dài',
            'input_id.exists' => 'Error 15: Tài liệu không tồn tại',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route("bookingHome")->withErrors($validator)->withInput();
        } else {
//Tim tai lieu
            $documentStatistics = TblStatistics::find($request->input_id);
//Kiem tra tai lieu ton tai
            if ($documentStatistics == "")
                return redirect()->back()->withErrors("Error 01: Tài liệu không tồn tại")->withInput();
            if ($documentStatistics->ready <= 0)
                return redirect()->back()->withErrors("Error 02: Rất tiếc, Tài liệu đã được cho đặt/mượn hết")->withInput();
//Check quyen
            $user = Auth::user();
            if ($user == "")
                return redirect()->back()->withErrors("Error 03: Người dùng không tồn tại")->withInput();
            if ($documentStatistics->department == "Mật mã" && $user->department != "Mật mã")
                return redirect()->back()->withErrors("Error 04: Chỉ khoa mật mã mới được mượn tài liệu này")->withInput();
            if ($documentStatistics->type == "Giáo án" && $user->role != "Giáo viên")
                return redirect()->back()->withErrors("Error 05: Chỉ giáo viên mới được mượn tài liệu này")->withInput();
//Kiem tra so luong da muon + trung
//            $borrow = TblBorrow::where('username', $user->username)->where('booking_status', 4)->first();
//            if ($borrow != null)
//                return redirect()->back()->withErrors("Error 06: Chưa xóa tài liệu bị từ chối")->withInput();
            $borrow = TblBorrow::where('username', $user->username)->get();
//            return $borrow;
            if (count($borrow) >= 3)
                return redirect()->back()->withErrors("Error 07: Chỉ được mượn tổng tối đa 3 quyển")->withInput();
//random 1 quyển sách trong bộ
            $document = TblDocument::where('document_name', $documentStatistics->document_name)
                    ->where('author', $documentStatistics->author)
                    ->where('type', $documentStatistics->type)
                    ->where('department', $documentStatistics->department)
                    ->whereNull('borrow_by')
                    ->first();
            if ($document == null)
                return redirect()->back()->withErrors("Error 09: Rất tiếc, Tài liệu đã được đặt/mượn hết")->withInput();
//Kiểm tra xem mượn chưa
            foreach ($borrow as $data) {
                if ($data->expiry < 0)
                    return redirect()->back()->withErrors("Error 08: Bạn phải trả tài liệu đã hết hạn mới được mượn tiếp")->withInput();
                if ($data->document_code == $document->id && $data->booking_status != 5)
                    return redirect()->back()->withErrors("Error 09: Bạn đã đăng ký muốn mượn quyển này")->withInput();
                if ($data->document_code != $document->id && $data->booking_status == 5) {
                    $document2 = TblDocument::where('id', $data->document_code)
                            ->where('document_name', $documentStatistics->document_name)
                            ->where('author', $documentStatistics->author)
                            ->where('type', $documentStatistics->type)
                            ->where('department', $documentStatistics->department)
                            ->first();
                    if ($document2 != "")
                        return redirect()->back()->withErrors("Error 10: Bạn đang mượn quyển này")->withInput();
                }
            }
//Tao phieu muon
            $borrow = new TblBorrow();
            $borrow->id = Uuid::generate(4);
            $borrow->username = $user->username;
            $borrow->document_code = $document->id;
            $borrow->document_status = $document->document_status;
            $borrow->expiry = $request->input_expiry;
            $borrow->created_by = Auth::user()->username;
            $borrow->save();
//Update tai lieu
            $documentStatistics->ready = $documentStatistics->ready - 1;
            $documentStatistics->save();
            return redirect()->back()->with('success', 'Muốn mượn thành công')->withInput();
        }
    }

    public function bookingDelete(Request $request) {
        $rules = [
            'input_document_code' => 'required| string| max: 36 | regex:/^[a-zA-Z0-9\-]+$/',
        ];
        $messages = [
            'input_document_code.required' => 'Phải chọn một tài liệu',
            'input_document_code.max' => ' Mã phiếu mượn quá dài',
            'input_document_code.regex' => ' Mã phiếu mượn chứa ký tự đặc biệt'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrow = TblBorrow::where('document_code', $request->input_document_code)->first();
            if ($borrow == null) {
                return redirect()->back()->withErrors("Bản ghi không tồn tại")->withInput();
            } else if ($borrow->booking_status == 1 || $borrow->booking_status == 0 || $borrow->booking_status == 4) {
                $document = TblDocument::where('id', $request->input_document_code)->first();
                if ($document == null) {
                    $borrow->delete();
                    return redirect()->back()->with('success', 'Xóa thành công');
                } else {
                    $documentStatistics = TblStatistics::where('document_name', $document->document_name)
                            ->where('author', $document->author)
                            ->where('type', $document->type)
                            ->where('department', $document->department)
                            ->first();
                    if ($documentStatistics != null) {
                        $documentStatistics->ready++;
                        $documentStatistics->save();
                        $borrow->delete();
                        return redirect()->back()->with('success', 'Xóa thành công');
                    } else {
                        $borrow->delete();
                        return redirect()->back()->with('success', 'Xóa thành công');
                    }
                }
            } else {
                return redirect()->back()->withErrors("Không thế xóa bản ghi đang chờ xử lý hoặc đã nhận sách")->withInput();
            }
            return redirect()->back()->with('success', 'Xóa thành công');
        }
    }

    public function bookingSetTimeAndSentRequest(Request $request) {
        $rules = [
            'input_booking_time' => 'required | date_format:y/m/d|regex:/^\d\d\/\d\d\/\d\d$/',
        ];
        $messages = [
            'input_booking_time.required' => 'Thời gian hẹn không được để trống',
            'input_booking_time.date_format' => 'Thời gian hẹn phải có định dạng thời gian Năm-Tháng-Ngày',
            'input_booking_time.regex' => 'Chứa ký tự đặc biệt',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $account = Auth::user();
            $borrow = TblBorrow:: where('username', $account->username)
                    ->where('booking_status', 0)
                    ->orWhere('booking_status', 1)
                    ->update(['booking_status' => 1, 'booking_time' => $request->input_booking_time]);
            $log = new TblLog();
            $log->message = $account->username . " đã xin xác nhận phiếu hẹn ";

            $log->created_by = $account->username;
            $log->save();
            return redirect()->back()->with('success', 'Hẹn thành công, đang chờ xét duyệt');
        }
    }

}
