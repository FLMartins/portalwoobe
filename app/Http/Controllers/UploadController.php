<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use Auth;
use File;
use Response;
use Storage;
use Log;

class UploadController extends Controller
{
    public function index(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
    	$files = $this->getUploadImages();
    	$dados = [
    		'files'=>$files,
    		'user'=>Auth::user()
    	];
    	return view('admin.galeria.index', $dados);
    }

    public function upload(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $img = Input::file('image');
    	$file = array('image' => $img);
    	$rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:10000');
    	$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
			// send back to the page with the input data and errors
			return redirect()->route('galeria')->withInput()->withErrors($validator);
		}else{
			if ($img->isValid()) {
				$destinationPath = 'uploads'; // upload path
                $fileContents = file_get_contents(Input::file('image'));
				$extension = $img->getClientOriginalExtension(); // getting image extension
                $fileName = $img->getClientOriginalName(); // renameing image
				//$fileName = time().'.'.$extension; // renameing image
                Storage::put($fileName, $fileContents);
				// sending back with message
				Session::flash('success', 'Upload com sucesso'); 
			}
			else {
				// sending back with error message.
				Session::flash('error', 'Arquivo inválido');
				return redirect()->back();
			}
		}
    	return redirect()->route('galeria');
    }

    public function ajaxUpload(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $img = Input::file('image');
        $file = array('image' => $img);
        $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:10000');
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Response::json(['error'=>'Escolha uma imagem']);
        }else{
            if ($img->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $fileContents = file_get_contents(Input::file('image'));
                $extension = $img->getClientOriginalExtension(); // getting image extension
                $fileName = $img->getClientOriginalName(); // renameing image
                //$fileName = time().'.'.$extension; // renameing image
                Storage::put($fileName, $fileContents);
                // sending back with message
                $url = asset('/uploads/'.($fileName));
                return Response::json(['success'=>'Upload com sucesso', 'url'=>$url]); 
            }
            else {
                // sending back with error message.
                return Response::json(['error'=>'Arquivo inválido']);
            }
        }
    }

    public function delete(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $img = Input::get('image');
        Storage::delete($img);
        return redirect()->route('galeria');
    }
}
