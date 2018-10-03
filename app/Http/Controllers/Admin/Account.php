<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TblRole;
use App\TblLog;
use App\TblDepartment;
use Validator;
use DB;
class Account extends Controller {

    public function postAdd(Request $request) {
        $rules = [
            'input_role' => 'required | max: 255',
            'input_user_name' => 'required | max: 255',
            'input_username' => 'required | unique:users,username| max: 255',
            'input_classroom' => 'required| max: 255',
            'input_course' => 'required| max: 255',
            'input_address' => 'required| max: 255',
            'input_avatar' => 'required | url| max: 1000',
            'input_department' => 'required| max: 255',
        ];
        $messages = [
            'input_account.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_avatar.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_avatar.url' => 'Đường dẫn ảnh phải là một liên kết',
            'input_address.required' => 'Địa chỉ không được để trống',
            'input_classroom.required' => 'Địa chỉ không được để trống',
            'input_course.required' => 'Khóa học không được để trống',
            'input_user_name.required' => 'Tên người dùng không được để trống',
            'input_role.required' => 'Quyền không được để trống',
            'input_user_name.required' => 'Tên người dùng không được để trống',
            'input_department.required' => 'Tên khoa không được để trống',
            'input_username.required' => 'Mã người dùng không được để trống',
            'input_username.unique' => 'Mã người dùng bị trùng (so sánh cả viết thường không dấu)',
            'input_username.alpha' => 'Mã người dùng chỉ được ký tự và số',
            'input_avatar.max' => 'Đường dẫn ảnh đại diện > 255 ký tự',
            'input_address.max' => 'Địa chỉ > 255 ký tự',
            'input_classroom.max' => 'Địa chỉ > 255 ký tự',
            'input_course.max' => 'Khóa học > 255 ký tự',
            'input_role.max' => 'Quyền > 255 ký tự',
            'input_user_name.max' => 'Tên người dùng > 255 ký tự',
            'input_department.max' => 'Tên khoa > 255 ký tự',
            'input_username.max' => 'Mã người > 255 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $account = new User();
            $account->id = $request->input_user_code;
            $account->name = $request->input_user_name;
            $account->role = $request->input_role;
            $account->username = $request->input_username;
            $account->password = bcrypt($request->input_username);
            $account->course = $request->input_course;
            $account->classroom = $request->input_classroom;
            $account->department = $request->input_department;
            $account->address = $request->input_address;
            $account->avatar = $request->input_avatar;
            $account->created_by = Auth::user()->username;
            $account->save();


            //Tao Log
            $log = new TblLog();
            $log->message = "Đã thêm một tài khoản " . $request->input_user_name;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect()->back()->with('success', 'Thêm thành công')->withInput();
        }
    }

    public function getAdd() {
        $data['role'] = TblRole::all();
        $data['department'] = TblDepartment::all();
        return view('admin/account/add', $data);
    }
    public function getHistory() {
        $data['log'] = DB::table('log')->where('message', 'LIKE',"Đã thêm một tài khoản%")
                ->where('message', 'LIKE',"Đã sửa một tài khoản%")->where('message', 'LIKE',"Đã thêm một tài khoản%")
                ->orWhere('message', 'LIKE',"Đã xóa một tài khoản%")
                ->orWhere('message', 'LIKE',"Đã tự sửa%")
                ->orderBy('created_at', 'desc')
                ->get();
        return view('admin/account/history', $data);
    }
    public function getAll() {
        $data['account'] = User::all()->sortByDesc('updated_at');
        return view('admin/account/all', $data);
    }

    public function delete($id) {
        $account = User::find($id);
        if ($account == "")
            return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
        $account->delete();
        //Tao Log
        $log = new TblLog();
        $log->message = "Đã xóa một tài khoản " . $account->username;
        $log->created_by = Auth::user()->username;
        $log->save();
        return redirect()->back()->with('success', 'Xóa thành công');
    }

    public function getEdit($id) {
        $data['account'] = User::find($id);
        $data['role'] = TblRole::all();
        $data['department'] = TblDepartment::all();
        if ($data['account'] == "")
            return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
        return view('admin/account/edit', $data);
    }

    public function postEdit($id, Request $request) {
        $rules = [
            'input_role' => 'required | max: 255',
            'input_user_name' => 'required | max: 255',
            'input_classroom' => 'required| max: 255',
            'input_course' => 'required| max: 255',
            'input_address' => 'required| max: 255',
            'input_avatar' => 'required | url| max: 255',
            'input_department' => 'required',
        ];
        $messages = [
            'input_account.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_avatar.required' => 'Đường dẫn ảnh đại diện không được để trống',
            'input_address.required' => 'Địa chỉ không được để trống',
            'input_classroom.required' => 'Địa chỉ không được để trống',
            'input_account.required' => 'Lớp học không được để trống',
            'input_course.required' => 'Khóa học không được để trống',
            'input_name_user.required' => 'Tên người dùng không được để trống',
            'input_role.required' => 'Quyền không được để trống',
            'input_department.required' => 'Khoa không được để trống',
            'input_avatar.max' => 'Đường dẫn ảnh đại diện > 255 ký tự',
            'input_address.max' => 'Địa chỉ > 255 ký tự',
            'input_classroom.max' => 'Địa chỉ > 255 ký tự',
            'input_course.max' => 'Khóa học > 255 ký tự',
            'input_role.max' => 'Quyền > 255 ký tự',
            'input_user_name.max' => 'Tên người dùng > 255 ký tự',
            'input_department.max' => 'Tên khoa > 255 ký tự',
            'input_username.max' => 'Mã người > 255 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $account = User::find($id);
            if ($account == "")
                return redirect()->back()->withErrors("Tài khoản không tồn tại")->withInput();
            $account->name = $request->input_user_name;
            $account->role = $request->input_role;
            $account->course = $request->input_course;
            $account->classroom = $request->input_classroom;
            $account->address = $request->input_address;
            $account->avatar = $request->input_avatar;
            $account->department = $request->input_department;
            $account->updated_by = Auth::user()->username;
            $account->save();
            //Tao Log
            $log = new TblLog();
            $log->message = "Đã sửa một tài khoản " . $account->username;
            $log->created_by = Auth::user()->username;
            $log->save();
            return redirect(url('admin/account/all'))->with('success', 'Sửa thành công');
        }
    }

}
