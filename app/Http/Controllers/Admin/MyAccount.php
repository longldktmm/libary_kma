<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblRole;
use Validator;
use DB;
use Webpatser\Uuid\Uuid;

class MyAccount extends Controller {

    public function get() {
        $data['account'] = Auth::user();
        if ($data['account'] == "")
            return redirect()->back()->withErrors("Bạn không có quyền truy cập");
        return view('admin/my_account/edit', $data);
    }

    public function post(Request $request) {
        $rules = [
            'input_address' => 'required',
            'input_avatar' => 'required',
            'input_new_password' => 'required_with: input_password',
        ];
        $messages = [
            'input_avatar.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_address.required' => 'Địa chỉ không được để trống',
            'input_new_password.required' => 'Mật khẩu mới không được để trống',
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
            $account->address = $request->input_address;
            $account->avatar = $request->input_avatar;
            $account->updated_by = Auth::user()->username;
            $account->save();
            return redirect(url('admin/account/myaccount'))->with('success', 'Sửa thành công');
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
            $account->password = bcrypt($request->input_new_password);
            $account->save();
            return redirect(url('logout'))->with('success', 'Thay đổi mật khẩu thành công');
        }
    }

}
