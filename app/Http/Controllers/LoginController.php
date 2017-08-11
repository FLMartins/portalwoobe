<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Auth;
use Hash;
use Log;

class LoginController extends Controller
{
	/**
     * Handle the index
     *
     * @return Response
     */
    public function login(){
    	if (Auth::check()) {
		    return redirect('/');
		}
    	return view('admin.login.index');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');
        Log::debug('Login: '.$email.' - '.$password);
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            $user = Auth::user();
            if(is_null($user->last_login))
                return redirect()->route('login.password');
            $user->last_login = Carbon::now();
            $user->update();
            return redirect()->intended('/');
        }else{
        	return redirect()->back()->withErrors(['Login incorreto']);
        }
    }

    /**
     * Handle an authentication attempt by facebook login button.
     *
     * @return Response
     */
    public function facebook(Request $request)
    {
        $name = $request->input('name-facebook');
        $email = $request->input('email-facebook');
        $password = $request->input('id-facebook');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return redirect()->route('posts');
        }else{
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            if(User::where('email', $user->email)->count() > 0)
                return redirect()->back()->withErrors(['O Email já esta em uso']);
            $user->save();
            if(Auth::login($user)){
                return redirect()->route('posts');
            }else{
                Log::error('Login via facebook nao realizado: '.$email);
                return redirect()->back()->withErrors(['Não foi possivel realizer o Login, tente novamente mais tarde']);
            }
        }
    }

    /**
     * Handle the logout
     *
     * @return Response
     */
    public function logout()
    {
        return view('admin.login.logout',['user'=>Auth::user()]);
    }

    /**
     * Handle the logout
     *
     * @return Response
     */
    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('posts');
    }

     /**
     * Handle the password change page
     *
     * @return Response
     */
    public function passwordUpdate()
    {
        $user = Auth::user();
        //Auth::logout();
        return view('admin.login.password', ['user'=>$user]);
    }

     /**
     * Handle an password update.
     *
     * @return Response
     */
    public function doPasswordUpdate(Request $request)
    {
        $user = Auth::user();
        $password_actual = $request->input('password_actual');
        $password_new = $request->input('password_1');
        $password_confirmation = $request->input('password_2');
        Log::debug('Login: '.$user->email.' - '.$password_actual);
        if(Auth::attempt(['email' => $user->email, 'password' => $password_actual]) 
            && $password_new == $password_confirmation){
            $user->password = Hash::make($password_new);
            $user->last_login = Carbon::now();
            $user->update();
            Auth::logout();
            return redirect()->route('login')->withErrors(['Senha alterada, realize um novo login']);
        }else{
            return redirect()->back()->withErrors(['Dados não conferem']);
        }
    }


}
