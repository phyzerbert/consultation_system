<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        if($user->role->name != 'Admin') return back()->with('success', "You can't access to this page.");
        $users = User::paginate(10);
        $current_page = 'user';
        if(null !== $request->get('page')){
            $page_number = $request->get('page');
        }else{
            $page_number = 1;
        }
        
        $data = array(
            'users' => $users,
            'page_number' => $page_number,
            'current_page' => $current_page
        );
        return view('admin.users', $data);
    }
    
    public function profile(Request $request){
        $user = Auth::user();
        $current_page = 'profile';
        
        $data = array(
            'user' => $user,
            'current_page' => $current_page
        );
        return view('profile', $data);
    }

    public function updateuser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|string|email',
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
        ]);
        $user = User::find($request->get("id"));
        $user->name = $request->get("name");
        $user->first_name = $request->get("first_name");
        $user->last_name = $request->get("last_name");
        $user->phone = $request->get("phone");
        $user->date_of_birth = $request->get("birthday");

        if($request->get('newpassword') != ''){
            $user->password = Hash::make($request->get('newpassword'));
        }
        if($request->has("picture")){
            $picture = request()->file('picture');
            $imageName = time().'.'.$picture->getClientOriginalExtension();
            $picture->move(public_path('images/profile_pictures'), $imageName);
            $user->picture = 'images/profile_pictures/'.$imageName;
        }
        $user->update();
        return back()->with("success", "Updated Profile Successfully.");
    }

    public function edituser(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|string|email',
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
        ]);
        $user = User::find($request->get("id"));
        $user->name = $request->get("name");
        $user->email = $request->get("email");
        $user->first_name = $request->get("first_name");
        $user->last_name = $request->get("last_name");
        $user->phone = $request->get("phone");

        if($request->get('newpassword') != ''){
            $user->password = Hash::make($request->get('newpassword'));
        }
        $user->save();
        return response()->json("success");
    }

    public function create(Request $request){
        $request->validate([
            'email'=>'required|email|unique:users',
            'name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required|digits_between:8,12',
            'password'=>'required|string|min:6|confirmed'
        ]);
        $cdt = date("Y-m-d");
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'phone' => $request->get('phone'),
            'date_of_birth' => $request->get('birthday'),
            'date_of_registration' => $cdt,
            'role_id' => 2,
            'password' => Hash::make($request->get('password'))
        ]);
        return response()->json('success');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return back()->with("success", "Deleted Successfully!");
    }
}
