<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Question;
use App\Category;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name;
        switch ($role) {
            case 'Admin':
                return redirect(route('admin.dashboard'));
                break;
            
            case 'Consultant':
                return redirect(route('consultant.dashboard'));
                break;
        
            case 'User':
                return redirect(route('user.dashboard'));
                break;
            
            default:
                return redirect(route('user.dashboard'));
                break;
        }
    }

    public function admin_index(Request $request){
        $current_page = 'dashboard';
        $categories = Category::all();
        $mod = new Question();
        $category_id = $subject = $status = $period = '';
        
        if ($request->has('category_id') && $request->get('category_id') != ""){
            $category_id = $request->get('category_id');
            $mod = $mod->where('category_id', $category_id);
        }
        if ($request->has('subject') && $request->get('subject') != ""){
            $subject = $request->get('subject');
            $mod = $mod->where('subject', 'LIKE', "%$subject%");
        }
        if ($request->has('status') && $request->get('status') != ""){
            $status = $request->get('status');
            $mod = $mod->where('status', $status);
        }
        if($request->has('period') && $request->get('period') != ""){   
            $period = $request->get('period');
            $from = substr($period, 0, 10);
            $to = substr($period, 14, 10);
            $mod = $mod->whereBetween('created_at', [$from, $to]);
        }
        $data = $mod->orderBy('created_at', 'desc')->paginate(10);
        if(null !== $request->get('page')){ $page_number = $request->get('page'); }else{ $page_number = 1; }
        return view('admin.dashboard', compact('data', 'categories', 'current_page', 'category_id', 'subject', 'status', 'period', 'page_number'));
    }

    public function user_index(Request $request){
        $current_page = 'dashboard';
        $categories = Category::all();
        return view('user.dashboard', compact('categories', 'current_page'));
    }

    public function user_question(Request $request){
        $user = Auth::user();
        $current_page = 'question';
        $categories = Category::all();
        $mod = $user->questions();
        $category_id = $subject = $status = $period = '';
        if ($request->has('category_id') && $request->get('category_id') != ""){
            $category_id = $request->get('category_id');
            $mod = $mod->where('category_id', $category_id);
        }
        if ($request->has('subject') && $request->get('subject') != ""){
            $subject = $request->get('subject');
            $mod = $mod->where('subject', 'LIKE', "%$subject%");
        }
        if ($request->has('status') && $request->get('status') != ""){
            $status = $request->get('status');
            $mod = $mod->where('status', $status);
        }
        if($request->has('period') && $request->get('period') != ""){   
            $period = $request->get('period');
            $from = substr($period, 0, 10);
            $to = substr($period, 14, 10);
            $mod = $mod->whereBetween('created_at', [$from, $to]);
        }
        $data = $mod->orderBy('created_at', 'desc')->paginate(10);
        if(null !== $request->get('page')){ $page_number = $request->get('page'); }else{ $page_number = 1; }
        return view('user.question', compact('data', 'categories', 'current_page', 'category_id', 'subject', 'status', 'period', 'page_number'));
    }

    public function consultant_index(Request $request){
        $current_page = 'dashboard';
        $categories = Category::all();
        $mod = new Question();
        $category_id = $subject = $status = $period = '';
        if ($request->has('category_id') && $request->get('category_id') != ""){
            $category_id = $request->get('category_id');
            $mod = $mod->where('category_id', $category_id);
        }
        if ($request->has('subject') && $request->get('subject') != ""){
            $subject = $request->get('subject');
            $mod = $mod->where('subject', 'LIKE', "%$subject%");
        }
        if ($request->has('status') && $request->get('status') != ""){
            $status = $request->get('status');
            $mod = $mod->where('status', $status);
        }
        if($request->has('period') && $request->get('period') != ""){   
            $period = $request->get('period');
            $from = substr($period, 0, 10);
            $to = substr($period, 14, 10);
            $mod = $mod->whereBetween('created_at', [$from, $to]);
        }
        $data = $mod->orderBy('created_at', 'desc')->paginate(10);
        if(null !== $request->get('page')){ $page_number = $request->get('page'); }else{ $page_number = 1; }
        return view('consultant.dashboard', compact('data', 'categories', 'current_page', 'category_id', 'subject', 'status', 'period', 'page_number'));
    }
}
