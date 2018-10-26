<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblLog;
use App\TblDocument;
use App\TblBorrow;
use Validator;
use Webpatser\Uuid\Uuid;
use DB;
use App\TblStatistics;

class Borrow extends Controller {

    public function postAdd($username, Request $request) {
        $rules = [
            'input_expiry' => 'numeric| min:1|max:120',
            'input_document_code' => 'required| max: 255',
        ];
        $messages = [
            'input_expiry.numeric' => 'Số ngày mượn phải là số',
            'input_expiry.min' => 'Mượn ít nhất 1 ngày',
            'input_expiry.max' => 'Mượn tối đa 120 ngày',
            'input_document_code.required' => 'Mã sách không được để trống',
            'input_document_code.max' => 'Mã sách quá dài',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
//Tim tai lieu
            $document = TblDocument::find($request->input_document_code);
//Kiem tra tai lieu ton tai
            if ($document == "")
                return redirect()->back()->withErrors("Tài liệu không tồn tại")->withInput();
            if ($document->borrow_by != "")
                return redirect()->back()->withErrors("Tài liệu đã được cho mượn")->withInput();
            if ($document->status == "Mất")
                return redirect()->back()->withErrors("Tài liệu đã được báo mất")->withInput();
            if ($document->status == "Hỏng")
                return redirect()->back()->withErrors("Tài liệu đã được báo hỏng")->withInput();
//Check quyen
            $user = User::where('username', $username)->first();
            if ($user == "")
                return redirect()->back()->withErrors("Người dùng không tồn tại")->withInput();
            if ($documentStatistics->department == "Mật mã" && $user->department != "Mật mã")
                return redirect()->back()->withErrors("Chỉ khoa mật mã mới được mượn tài liệu này")->withInput();
            if ($documentStatistics->type == "Giáo án" && $user->role != "Giáo viên")
                return redirect()->back()->withErrors("Chỉ giáo viên mới được mượn tài liệu này")->withInput();
//Kiểm tra số lượng, hết hạn            
            $borrow = TblBorrow::where('username', $username)->where('booking_status', 5)->orWhere('booking_status', 2)->get();
//            return $borrow;
            if (count($borrow) >= 3)
                return redirect()->back()->withErrors("Error 07: Chỉ được mượn tổng tối đa 3 quyển")->withInput();
//Kiểm tra xem mượn chưa
            foreach ($borrow as $data) {
                if ($data->expiry < 0)
                    return redirect()->back()->withErrors("Phải trả tài liệu đã hết hạn mới được mượn tiếp")->withInput();
                if ($data->document_code == $request->input_document_code)
                    return redirect()->back()->withErrors("Người dùng đang mượn quyển này")->withInput();
            }
//Tao phieu muon
            $borrow = new TblBorrow();
            $borrow->id = Uuid::generate(4);
            $borrow->document_code = $request->input_document_code;
            $borrow->username = $username;
            $borrow->expiry = $request->input_expiry;
            $borrow->document_status = $document->status;
            $borrow->booking_status = 5;
            $borrow->created_by = Auth::user()->username;
            $borrow->save();
//Update tai lieu
            $document->borrow_by = $borrow->id;
            $document->save();
//Upload so luong
            $documentStatistics = TblStatistics::where('document_name', $document->document_name)
                    ->where('author', $document->author)
                    ->where('type', $document->type)
                    ->where('department', $document->department)
                    ->first();
            if ($documentStatistics != null) {
                $documentStatistics->ready--;
                $documentStatistics->save();
            }
//Tao Log
            $log = new TblLog();
            $log->message = "Đã cho " . $username . " mượn một tài liệu mã " . $borrow->document_code;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect()->back()->with('success', 'Thêm thành công')->withInput();
        }
    }

    public function getAdd($username) {
        $rules = [
            'username' => 'required| max: 255 | regex:/^[a-zA-Z0-9\-]+$/',
        ];
        $messages = [
            'username.regex' => 'Mã người dùng chứa ký tự đặc biệt',
            'username.required' => 'Mã người dùng không được để trống',
            'username.max' => 'Mã người dùng quá dài',
        ];
        $validator = Validator::make(array('username' => $username), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $data['user'] = User::where('username', $username)->first();
            if ($data['user'] == "")
                return redirect()->back()->withErrors("Mã người dùng không tồn tại")->withInput();
            $data['borrow'] = DB::table('borrow')
                    ->where('username', $username)
                    ->join('document', 'borrow.document_code', '=', 'document.id')
                    ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                    ->select(['borrow.id as id', 'expiry', 'booking_time',
                        'booking_status_name', 'type', 'department',
                        'author', 'document_code', 'username',
                        'booking_status', 'document_name', 'booking_code', 'borrow.created_at as created_at', 'document_status'])
                    ->get();
//        $data['borrow'] = TblBorrow::where('username', $username)->get();
            return view('admin/borrow/borrow', $data);
        }
    }

    public function getHome() {
        return view('admin/borrow/home');
    }

    public function postHome(Request $request) {
        $rules = [
            'input_username' => 'required| max: 255 | regex:/^[a-zA-Z0-9\-]+$/|exists:users,username',
        ];
        $messages = [
            'input_username.max' => 'Mã người dùng quá dài',
            'input_username.required' => 'Mã người dùng không được để trống',
            'input_username.exists' => 'Mã người dùng không tồn tại',
            'input_username.regex' => 'Mã người dùng chứa ký tự đặc biệt',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return redirect()->route('userProfile', [$request->input_username]);
        }
    }

    public function delete($id) {
        $borrow = TblBorrow::where('id', $id)->first();
        if ($borrow == "")
            return redirect()->back()->withErrors("Phiếu mượn không tồn tại")->withInput();
        $borrow->delete();
        //Tim tai lieu
        $document = TblDocument::find($borrow->document_code);
//Kiem tra tai lieu ton tai
        if ($document != "" && is_null($document->borrow_by) == false && $borrow->booking_status == 5) {
            $document->borrow_by = null;
            $document->save;
            $documentStatistics = TblStatistics::where('document_name', $document->document_name)
                    ->where('author', $document->author)
                    ->where('type', $document->type)
                    ->where('department', $document->department)
                    ->first();
            if ($documentStatistics != null) {
                $documentStatistics->ready--;
                $documentStatistics->save();
            }
        }
        //Tao Log
        $log = new TblLog();
        $log->message = "Đã xóa phiếu mượn " . $borrow->id;
        $log->created_by = Auth::user()->username;
        $log->save();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getAll() {
        $data['borrow'] = DB::table('borrow')
                ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                ->join('document', 'borrow.document_code', '=', 'document.id')
                ->select(['borrow.id as id', 'expiry', 'booking_time',
                    'booking_status_name', 'type', 'department',
                    'author', 'document_code', 'username',
                    'booking_status', 'document_name', 'booking_code', 'borrow.created_at as created_at', 'document_status'])
                ->get();
//        $data['borrow'] = \App\TblBorrow::all()->sortByDesc('created_at');
        return view('admin/borrow/all', $data);
    }

    public function bookingGetVerify() {
        $dataFirst = DB::table('borrow')->where('booking_status', 1)->orderByRaw('updated_at DESC')->first();
        if ($dataFirst == null) {
            $data['user'] = [];
            $data['bookingData'] = [];
            $data['bookingDataVerify'] = [];
        } else {
            $data['bookingDataVerify'] = DB::table('borrow')
                    ->where('username', $dataFirst->username)
                    ->where('booking_status', 2)
                    ->orWhere('booking_status', 3)
                    ->orWhere('booking_status', 4)
                    ->orWhere('booking_status', 5)
                    ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                    ->get();
            $data['user'] = User::where('username', $dataFirst->username)->first();
            $data['bookingData'] = DB::table('borrow')
                    ->where('booking_status', 1)
                    ->where('username', $dataFirst->username)
                    ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                    ->join('document', 'borrow.document_code', '=', 'document.id')
                    ->select(['borrow.id as id', 'expiry', 'booking_time',
                        'booking_status_name', 'type', 'department',
                        'author', 'document_code', 'username',
                        'booking_status', 'document_name', 'booking_code'])
                    ->get();
        }
        return view('admin/borrow/booking/all', $data);
    }

    public function bookingGetWaiting() {
        $data['bookingDataVerify'] = DB::table('borrow')
                ->where('booking_status', 2)
                ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                ->select(['borrow.id as id', 'expiry', 'booking_time',
                    'booking_status_name', 'note', 'document_code', 'username',
                    'booking_status', 'booking_code'])
                ->get();
        return view('admin/borrow/booking/waiting', $data);
    }

    public function getAllBorrowing() {
        $data['borrow'] = DB::table('borrow')
                ->where('booking_status', 5)
                ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                ->join('document', 'borrow.document_code', '=', 'document.id')
                ->select(['borrow.id as id', 'expiry', 'booking_time',
                    'booking_status_name', 'type', 'department',
                    'author', 'document_code', 'username',
                    'booking_status', 'document_name', 'booking_code', 'borrow.created_at', 'document_status'])
                ->get();
        return view('admin/borrow/all', $data);
    }

    public function bookingGetAllowException() {
        $data['bookingDataException'] = DB::table('borrow')
                ->where('booking_status', 3)
                ->join('status_booking', 'status_booking.id', '=', 'borrow.booking_status')
                ->select(['borrow.id as id', 'expiry', 'booking_time',
                    'booking_status_name', 'note', 'document_code', 'username',
                    'booking_status', 'booking_code'])
                ->get();
        return view('admin/borrow/booking/exception', $data);
    }

    public function bookingDeny(Request $request) {
        $rules = [
            'input_booking_id' => 'required| string| max: 36',
            'input_note' => 'max: 255',
        ];
        $messages = [
            'input_booking_id.required' => 'Phải chọn một tài liệu',
            'input_booking_id.max' => ' Mã quá dài',
            'input_note.max' => ' Chú thích quá dài'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrow = TblBorrow::where('id', $request->input_booking_id)->first();
            if ($borrow == null) {
                return redirect()->back()->withErrors("Bản ghi không còn tồn tại")->withInput();
            } else if ($borrow->booking_status == 1) {
                $document = TblDocument::where('id', $borrow->document_code)->first();
                if ($document == null) {
                    $borrow->booking_status = 4;
                    $borrow->note = $request->input_note;
                    $borrow->save();
                    return redirect()->back()->with('success', 'Từ chối thành công, Cảnh báo mã tài liệu không tồn tại');
                } else {
                    $documentStatistics = TblStatistics::where('document_name', $document->document_name)
                            ->where('author', $document->author)
                            ->where('type', $document->type)
                            ->where('department', $document->department)
                            ->first();
                    if ($documentStatistics != null) {
                        $documentStatistics->ready++;
                        $documentStatistics->save();
                        $borrow->booking_status = 4;
                        $borrow->note = $request->input_note;
                        $borrow->save();
                        return redirect()->back()->with('success', 'Từ chối thành công');
                    } else {
                        $borrow->booking_status = 4;
                        $borrow->note = $request->input_note;
                        $borrow->save();
                        return redirect()->back()->with('success', 'Từ chối thành công, Cảnh báo thống kế không có bộ tài liệu này');
                    }
                }
            } else {
                return redirect()->back()->withErrors("Chỉ từ chối được bản ghi đang chờ xử lý")->withInput();
            }
            return redirect()->back()->with('success', 'Xóa thành công');
        }
    }

    public function bookingAllow(Request $request) {
        $rules = [
            'input_booking_id' => 'required| string| max: 36',
            'input_booking_code' => 'required| max: 255',
        ];
        $messages = [
            'input_booking_id.required' => 'Phải chọn một tài liệu',
            'input_booking_id.max' => ' Mã quá dài',
            'input_booking_code.max' => ' Mã gói hẹn quá dài',
            'input_booking_code.required' => 'Phải nhập mã gói hẹn',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrow = TblBorrow::where('id', $request->input_booking_id)->first();
            if ($borrow == null) {
                return redirect()->back()->withErrors("Bản ghi không còn tồn tại")->withInput();
            } else if ($borrow->booking_status == 1) {
                $document = TblDocument::where('id', $borrow->document_code)->first();
                $document_now = TblDocument::where('id', $request->input_document_code)->first();
                if ($document != null && $document_now != null) {
                    if ($document->document_name != $document_now->document_name || $document->author != $document_now->author || $document->type != $document_now->type || $document->department != $document_now->department
                    ) {
                        return redirect()->back()->withErrors("Nội dung tài liệu đã nhập không giống như yêu cầu")->withInput();
                    }
                    if ($document_now->borrow_by != null) {
                        return redirect()->back()->withErrors("Mã tài liệu đã nhập đang cho mượn")->withInput();
                    } // nếu không cập nhập brrrow_by thì dễ xóa 2
                    $borrow->booking_status = 2;
                    $borrow->document_code = $document_now->id;
                    $borrow->document_status = $document_now->status;
                    $borrow->save();
                    $borrow = TblBorrow:: where('username', $borrow->username)
                            ->where('booking_status', 2)
                            ->orWhere('booking_status', 1)
                            ->update(['booking_code' => $request->input_booking_code, 'booking_time' => $borrow->booking_time]);
                    return redirect()->back()->with('success', 'Duyệt thành công');
                } else {
                    return redirect()->back()->withErrors("Mã tài liệu không tồn tại")->withInput();
                }
            } else {
                return redirect()->back()->withErrors("Chỉ duyệt được bản ghi đang chờ xử lý")->withInput();
            }
            return redirect()->back()->with('success', 'Duyệt thành công');
        }
    }

    public function bookingLend(Request $request) {
        $rules = [
            'input_borrow_id' => 'required| string| max: 36'
        ];
        $messages = [
            'input_borrow_id.required' => 'Phải nhập một mã phiếu mượn',
            'input_borrow_id.max' => ' Mã quá dài',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrow = TblBorrow::where('id', $request->input_borrow_id)->first();
            if ($borrow == null) {
                return redirect()->back()->withErrors("Bản ghi không còn tồn tại")->withInput();
            } else if ($borrow->booking_status == 2 || $borrow->booking_status == 3) {
                $borrow->booking_status = 5;
                $borrow->save();
                $document = TblDocument::where('id', $borrow->document_code)->first();
                if ($document == null) {
                    return redirect()->back()->withErrors("Mã tài liệu không còn tồn tại")->withInput();
                } else {
                    $document->save();
                }
                $log = new TblLog();
                $log->message = "Đã giao cho " . $borrow->username . " 1 tài liệu mã " . $borrow->document_code;
                $log->created_by = Auth::user()->username;
                $log->save();
                return redirect()->back()->with('success', 'Giao tài liệu thành công');
            } else {
                return redirect()->back()->withErrors("Phiếu mượn không phải đang chờ đến nhận hoặc ngoại lệ")->withInput();
            }
        }
    }

    public function bookingAllowException(Request $request) {
        $rules = [
            'input_borrow_id' => 'required| string| max: 36'
        ];
        $messages = [
            'input_borrow_id.required' => 'Phải nhập một mã phiếu mượn',
            'input_borrow_id.max' => ' Mã quá dài',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $borrow = TblBorrow::where('id', $request->input_borrow_id)->first();
            if ($borrow == null) {
                return redirect()->back()->withErrors("Bản ghi không còn tồn tại")->withInput();
            } else if ($borrow->booking_status == 2) {
                $borrow->booking_status = 3;
                $borrow->save();
                $log = new TblLog();
                $log->message = "Đã cho " . $borrow->username . " ngoại lệ phiếu mượn " . $borrow->document_code;
                $log->created_by = Auth::user()->username;
                $log->save();
                return redirect()->back()->with('success', 'Thêm vào ngoại lệ thành công');
            } else {
                return redirect()->back()->withErrors("Phiếu mượn không phải đang chờ đến nhận")->withInput();
            }
        }
    }

}
