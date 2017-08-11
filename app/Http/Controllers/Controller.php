<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Auth;
use Storage;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function checkLogin(){
    	if (!Auth::check()) {
		    return redirect()->route('login')->withErrors(['Acesso não autorizado']);
		}else{
            $user = Auth::user();
            if(is_null($user->last_login))
                return redirect()->route('login.password')->withErrors(['Por favor atualize sua senha!']);
        }
		return null;
    }
    public function checkLoginModerator(){
        if (!Auth::check() || (!Auth::user()->moderator && !Auth::user()->author)) {
            //return redirect()->route('login')->withErrors(['Acesso não autorizado']);
        }else{
            $user = Auth::user();
            if(is_null($user->last_login))
                return redirect()->route('login.password')->withErrors(['Por favor atualize sua senha!']);
        }
        return null;
    }
    public function checkLoginAdmin(){
    	if (!Auth::check() || !Auth::user()->admin) {
		    return redirect()->route('login')->withErrors(['Acesso não autorizado']);
		}else{
            $user = Auth::user();
            if(is_null($user->last_login))
                return redirect()->route('login.password')->withErrors(['Por favor atualize sua senha!']);
        }
		return null;
    }
    public function getUploadImages($numImages = -1){
        if($numImages==-1)
        $filesArray = Storage::files();
        $files = Array();
        foreach ($filesArray as $f) {
            $url = asset('/uploads/'.($f));
            $data = Carbon::createFromTimestamp(Storage::lastModified($f))->format('d/m/Y');
            array_push($files, ['name'=>$f, 'url'=>$url, 'data'=>$data]);
        }
        return $files;
    }
}
