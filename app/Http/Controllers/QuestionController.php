<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Response;
use App\Attachment;

use Auth;

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
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $question = Question::create($data);
        if($request->has("file_path")){
            $attachment = request()->file('file_path');
            $imageName = time().'.'.$attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/question_attachments'), $imageName);
            $path = 'uploads/question_attachments/'.$imageName;
            Attachment::create([
                'parent_id' => $question->id,
                'type' => 1,
                'path' => $path,
            ]);
        }
        return back()->with('success', 'Requested Successfully.');
    }

    public function delete($id){
        $question = Question::find($id);
        $attachments = $question->attachments();
        foreach ($attachments as $item) {
            $item->delete();
        }
        $question->delete();
        return back()->with('Deleted Successfully');
    }

    public function close($id){
        $question = Question::find($id);
        $question->status = 2;
        $question->save();
        return back()->with('Closed Successfully');
    }

    public function accept($id){
        $question = Question::find($id);
        $question->status = 1;
        $question->consultant_id = Auth::user()->id;
        $question->save();
        return back()->with('Accepted Successfully');
    }

    public function reply_index($id){        
        $current_page = 'dashboard';
        $question = Question::find($id);
        if(Auth::user()->id != $question->user_id && Auth::user()->id != $question->consultant_id){
            return back()->withErrors(['not_allowed' => 'You can not reply to this question.']);
        }
        $responses = $question->responses;
        return view('reply', compact('question', 'responses', 'current_page'));
    }

    public function reply(Request $request){
        $id = $request->get('question_id');
        $question = Question::find($id);
        $user_id = Auth::user()->id;        
        if($user_id != $question->user_id && $user_id != $question->consultant_id){
            return back()->withErrors(['not_allowed' => 'You can not reply to this question.']);
        }
        $response_text = $request->get('response_text');
        $response = Response::create([
            'question_id' => $question->id,
            'user_id' => $user_id,
            'response_text' => $response_text,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
        ]);
        if($request->has("file_path")){
            $attachment = request()->file('file_path');
            $imageName = time().'.'.$attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/question_attachments'), $imageName);
            $path = 'uploads/question_attachments/'.$imageName;            
            Attachment::create([
                'parent_id' => $response->id,
                'type' => 2,
                'path' => $path,
            ]);
        }
        return back()->with('Replied Successfully');
    }

    public function get_question_data(Request $request){
        $id = $request->get("id");
        $question = Question::find($id);
        return response()->json($question);
    }
}
