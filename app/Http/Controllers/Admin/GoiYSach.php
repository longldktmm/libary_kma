<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\TblTopic;
use \App\TblSubject;
use \App\TblLevel;
use \App\TblClass;
use \App\TblQuestion;
use Validator;
class Question extends Controller {
    private $sql = "";
    public function postAdd(Request $request) {
        $rules = [
            'input_content' => 'required',
            'input_answer_a' => 'required',
            'input_answer_b' => 'required',
            'input_answer_c' => 'required',
            'input_answer_d' => 'required',
            'input_correct_answer' => 'required',
            'input_class' => 'required',
            'input_topic' => 'required',
            'input_level' => 'required',
            'input_subject' => 'required',
            'input_lecturer' => 'required',
        ];
        $messages = [
            'input_content.required' => 'Nội dung câu hỏi không được để trống',
            'input_answer_a.required' => 'Câu trả lời A không được để trống',
            'input_answer_b.required' => 'Câu trả lời B không được để trống',
            'input_answer_c.required' => 'Câu trả lời C không được để trống',
            'input_answer_d.required' => 'Câu trả lời D không được để trống',
            'input_correct_answer.required' => 'Đáp án không được để trống',
            'input_class.required' => 'Vui lòng chọn một lớp',
            'input_topic.required' => 'Vui lòng chọn một chủ đề',
            'input_subject.required' => 'Vui lòng chọn một môn học',
            'input_level.required' => 'Vui lòng chọn một độ khó',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $ques = new TblQuestion();
            $ques->content = $request->input_content;
            $ques->answer_a = $request->input_answer_a;
            $ques->answer_b = $request->input_answer_b;
            $ques->answer_c = $request->input_answer_c;
            $ques->answer_d = $request->input_answer_d;
            $ques->correct_answer = $request->input_correct_answer;
            $ques->explan = $request->input_explan;
            $ques->id_topic = $request->input_topic;
            $ques->id_class = $request->input_class;
            $ques->id_subject = $request->input_subject;
            $ques->id_level = $request->input_level;
            $ques->id_lecturer = $request->input_lecturer;
            $ques->feedback = $request->input_feedback;
            $ques->save();
            return redirect()->back()->with('success', ['Thêm thành công']);
        }
        return view('admin/question/add');
    }

    public function getAdd() {
        $data['subject'] = TblSubject::all();
        $data['class'] = TblClass::all();
        $data['topic'] = TblTopic::all();
        $data['level'] = TblLevel::all();
        return view('admin/question/add', $data);
    }

    public function all() {
//        $data['data'] = TblQuestion::all();
//        $data['data'] = DB::table('question')
//                ->join('level', 'level.id', '=', 'question.id_level')
//                ->join('subject', 'subject.id', '=', 'question.id_subject')
//                ->join('topic', 'topic.id', '=', 'question.id_topic')
//                ->join('class', 'class.id', '=', 'question.id_class')
//                ->get();
////        $data['data'] = json_decode( json_encode($data['data']), true);
         $sql = "SELECT question.id, class.name as class, topic.name as topic 
, subject.name as subject, level.name as level, question.content
, question.answer_a, question.answer_b, question.answer_c, question.answer_d
,question.correct_answer, question.explan, question.feedback, question.id_lecturer 
FROM avs01.question join class on class.id = id_class 
join level on level.id = id_level
join topic on topic.id = id_topic
join subject on subject.id = id_subject";
        $data['question'] = DB::select( DB::raw($sql));
        $sql="";
//        foreach ($data as $item){
//            return $item;
//        }
//        return $data->question;
        return view('admin/question/all', $data);
    }

}
