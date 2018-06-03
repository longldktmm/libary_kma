<?php

namespace App\Http\Controllers;

use \App\MathsQuestion;
use Illuminate\Http\Request;
use Validator;
use DateTime;
class MyFirstController extends Controller {

    public function getController($stn, $sth) {
        $tong = $stn + $sth;
        return $tong;
    }

    public function getView() {
        $data['data'] = MathsQuestion::all();
        return view('MyFirstView', $data);
    }

    public function getAddQuestion() {
        echo "Đã post dữ liệu";
        return redirect('xxx');
    }

    public function postAddQuestion(Request $request) {
        $rules = [
            'cauHoi' => 'required',
            'A' => 'required',
            'B' => 'required',
            'C' => 'required',
            'D' => 'required',
            'dapAn' => 'required',
        ];
        $messages = [
            'cauHoi.required' => 'Câu hỏi không được để trống',
            'A.required' => 'Câu trả lời A không được để trống',
            'B.required' => 'Câu trả lời B không được để trống',
            'C.required' => 'Câu trả lời C không được để trống',
            'D.required' => 'Câu trả lời D không được để trống',
            'dapAn.required' => 'Đáp án không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
                     echo '<script type="text/javascript">
                  alert("Không thể xóa danh mục này !");                
                window.location = "';
            echo '";
         </script>';
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $ques = new MathsQuestion();
            $ques->question = $request->cauHoi;
            $ques->a = $request->A;
            $ques->b = $request->B;
            $ques->c = $request->C;
            $ques->d = $request->D;
            $ques->answer = $request->dapAn;
            $ques->created_at = new DateTime;
            $ques->updated_at = new DateTime;
            $ques->save();
             return redirect()->back()->with('success', ['Thêm thành công']);   

        }
    }

}
