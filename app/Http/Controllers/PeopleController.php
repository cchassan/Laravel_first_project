<?php

namespace App\Http\Controllers;

use http\Url;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $data = compact('url' ,'title' , 'user');
        return view('addUser') ->with($data);
    }

    public function store(Request $request){

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8',],
            ]
        );
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->save();
        return redirect()->route('users');
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
            $data = compact('user', 'url', 'title');
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
            ]
        );

        $user->name = $request->name;
        $user->email = ($request->email == $user->email) ? $user->email : $request->email;
        $user->phone = $request->phone;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
//        $user->password = is_null($request->password) ? $user->password : Hash::make($request->password);
        $user->address = $request->address;
        $user->update();
        return redirect()->route('users');

    }

    public function delete ($id){

        $user = User::find($id);
        if(!is_null($user)) {
            $user->delete();
        }
        return redirect()->route('users');
    }
}
