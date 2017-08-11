<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use Auth;
use Hash;
use Log;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Utils\EmailUtils;
use Session;

class AdminController extends Controller
{

	/**
	* Handle the index
	*
	* @return Response
	*/
    public function index(Request $request){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
		$users = User::orderBy('name', 'asc')->get();
    	return view('admin.user.lista', ['users'=>$users, 'user'=>Auth::user()]);
    }

	/**
	* Handle the new user
	*
	* @return Response
	*/
    public function user(){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
    	return view('admin.user.user', ['u'=>new User,'user'=>Auth::user()]);
    }

    /**
	* Handle the new user
	*
	* @return Response
	*/
    public function edit($id){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
   		return view('admin.user.user', ['u'=>User::find($id),'user'=>Auth::user()]);
    }

	/**
	* Save the new user
	*
	* @return Response
	*/
    public function save(UserRequest $request){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
    	$user = new User();
    	$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->admin = $request->input('admin') || 0;
        $user->moderator = $request->input('moderator') || 0;
        $user->author = $request->input('author') || 0;
        $password = env("USER_DEFAULT_PASSWORD", str_random(12));
    	$user->password = Hash::make($password);
		if(User::where('email', $user->email)->count() > 0)
			return redirect()->back()->withErrors(['O Email já esta em uso']);
		$user->save();
        EmailUtils::sendWelcomeMail($user->name, $user->email, $password);
        Session::flash('success', 'Usuário criado com sucesso'); 
    	return redirect()->route('admin');
    }

    /**
	* Update the user
	*
	* @return Response
	*/
    public function update(UserRequest $request, $id){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
    	$user = User::find($id);
    	$exists = User::where('email', $request->input('email'))->first();
		if( isset($exists) && $exists->id != $user->id){
			return redirect()->back()->withErrors(['O Email já esta em uso']);
		}
		$user->name = $request->input('name');
    	$user->email = $request->input('email');
    	$user->admin = $request->input('admin') || 0;
        $user->moderator = $request->input('moderator') || 0;
        $user->author = $request->input('author') || 0;
    	$user->update();
        Session::flash('success', 'Usuário alterado com sucesso'); 
    	return redirect()->route('admin');
    }

    /**
	* Delete the user
	*
	* @return Response
	*/
    public function delete(){
    	$view = self::checkLoginAdmin();
    	if(isset($view))
    		return $view;
    	$id = Input::get('id');
        $count = \App\Post::where('user_id', $id)->count();
        if($count>0)
            return redirect()->back()->withErrors(['Existem postagens vinculadas ao usuário','Não é possivel deletar']);
    	User::destroy($id);
        Session::flash('success', 'Usuário excluido com sucesso'); 
	    return redirect('admin');
    }

    /**
    * Generate a new user password
    *
    * @return Response
    */
    public function reset(){
        $view = self::checkLoginAdmin();
        if(isset($view))
            return $view;
        $user = User::find(Input::get('id'));
        $password = str_random(12);
        $user->password = Hash::make($password);
        $user->update();
        EmailUtils::sendResetMail($user->name, $user->email, $password);
        Session::flash('success', 'Senha resetada com sucesso'); 
        return redirect('admin');
    }


}
