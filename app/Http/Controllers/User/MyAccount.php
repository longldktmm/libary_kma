<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\TblLog;

class MyAccount extends Controller {

    public function get() {
        $data['account'] = Auth::user();
        if ($data['account'] == "")
            return redirect()->back()->withErrors("Bạn không có quyền truy cập");
        return view('user/my_account/edit', $data);
    }

    public function post(Request $request) {
        $rules = [
            'input_address' => 'required|max:2000',
            'input_avatar' => 'required| max: 1000',
        ];
        $messages = [
            'input_avatar.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_avatar.max' => 'Đường dẫn ảnh đại diện phải nhỏ hơn 1000 ký tự',
            'input_address.required' => 'Địa chỉ không được để trống',
            'input_address.max' => 'Địa chỉ phải nhỏ hơn 2000 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $account = Auth::user();
            if ($account == "")
                return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
//            if ($request->input_password != "") {
//                return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
//            }
            $account->classroom = $request->input_classroom;
            $account->avatar = $request->input_avatar;
            $account->address = $request->input_address;
            $account->updated_by = Auth::user()->username;
            $account->save();
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã tự sửa thông tin ";
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect(url('myaccount'))->with('success', 'Sửa thành công');
        }
    }

    public function changePwd(Request $request) {
        $rules = [
            'input_new_password' => 'required | min: 8',
        ];
        $messages = [
            'input_new_password.required' => 'Mật khẩu mới không được để trống',
            'input_new_password.min' => 'Mật khẩu mới phải ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $account = Auth::user();
            if ($account == "")
                return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
//            if ($request->input_password != "") {
//                return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
//            }
            $account->password = bcrypt($request->input_new_password);
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã tự đổi mật khẩu ";
            $log->created_by = Auth::user()->username;
            $log->save();
            $account->save();

            return redirect(url('logout'))->with('success', 'Thay đổi mật khẩu thành công');
        }
    }

}
