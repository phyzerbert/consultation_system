<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subject'=>'required',
            'description'=>'required',
        ]);
        $data = $request->all();
        if($request->has("file_path")){
            $attachment = request()->file('file_path');
            $imageName = time().'.'.$attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/question_attachments'), $imageName);
            $data['file_path'] = 'uploads/question_attachments/'.$imageName;
        }
        Question::create($data);
        return back()->with('success', 'Requested Successfully.');
    }

    public function delete($id){
        $question = Question::find($id);
        $question->delete();
        return back()->with('Deleted Successfully');
    }

    public function close($id){
        $question = Question::find($id);
        $question->status = 2;
        $question->save();
        return back()->with('Closed Successfully');
    }

    public function reply(Request $request){
        $id = $request->get('id');
        $question = Question::find($id);
        $question->consultant_id = $request->get('consultant_id');
        $question->answer = $request->get('answer');
        $question->status = 1;
        $question->save();
        return back()->with('Replied Successfully');
    }

    public function get_question_data(Request $request){
        $id = $request->get("id");
        $question = Question::find($id);
        return response()->json($question);
    }
}
