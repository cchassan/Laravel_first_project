<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class PeopleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::all();
        $data = compact('users');
        return view('users') ->with($data);
    }
    public function create()
    {
        $url = route('users.store');
        $title = "Create User";
        $user = new User;
        $roles = Role::pluck('name','name')->all();
        $data = compact('url' ,'title' , 'user','roles');
        return view('addUser') ->with($data);
    }

    public function store(Request $request){

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8',],
                'roles' => 'required'
            ]
        );
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->assignRole($request->input('roles'));
        $user->save();
        $message = array(
            'message' => "User Added Successfully.",
            'type'=> "success",
        );
        return redirect()->route('users')->with($message);
    }


    public function edit($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return redirect()->route('users');
        }else {
//            $url = url('/users/update/') ."/".$id;
            $url = route('users.update',$id) ;
            $title = "Edit User";
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
            $data = compact('user', 'url', 'title', 'roles', 'userRole');
            return view('addUser') ->with($data);
        }
    }

    public function update($id, Request $request){
        $user = User::find($id);
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
               is_null($request->password) ? : 'password' => ['string', 'min:8',],
                'roles' => 'required'
            ]
        );

        $user->name = $request->name;
        $user->email = ($request->email == $user->email) ? $user->email : $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
//        $user->password = is_null($request->password) ? $user->password : Hash::make($request->password);
        $user->address = $request->address;
        $user->update();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        $message = array(
            'message' => "User Update Successfully.",
            'type'=> "success",
        );
        return redirect()->route('users')->with($message);

    }

    public function delete ($id){

        $user = User::find($id);
        if(!is_null($user)) {
            $user->delete();
        }
        $message = array(
            'message' => "User Delete Successfully.",
            'type'=> "success",
        );
        return redirect()->route('users') -> with($message);
    }
}
