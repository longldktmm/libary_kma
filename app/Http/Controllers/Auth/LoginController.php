<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\TblLog;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

class LoginController extends Controller {

    public function getLogout() {
        Auth::logout();
        return redirect('login');
    }

    public function getLogin() {
        return view('login');
    }

    public function postLogin(Request $request) {
        $rules = [
            'username' => 'required|min:1',
            'password' => 'required|min:4'
        ];
        $messages = [
            'username.required' => 'Tên đăng nhập là trường bắt buộc',
            'username.min' => 'Tên đăng nhập không được để trống',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $username = $request->input('username');
            $password = $request->input('password');

            if (Auth::attempt(['username' => $username, 'password' => $password])) {
                //Tao Log
                $log = new TblLog();
                $log->message = $username . " đã đăng nhập";
                $log->created_by = "System";
                $log->save();
                if (Auth::user()->role == "Admin") {
//                    return $next($request); 
                    return redirect('/admin');
                } else {
                    return redirect('');
                }
            } else {
                $errors = new MessageBag(['errorlogin' => 'Tên đăng nhập hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

}
