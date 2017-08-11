<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Auth;
use App\Categoria;
use Session;

class CategoriaController extends Controller
{
	public function index(){
	    $view = self::checkLoginModerator();
	    if(isset($view))
	        return $view;
		return view('admin.categoria.index', ['categorias'=>Categoria::all(), 'user'=>Auth::user()]);
	}

	public function save(){
	    $view = self::checkLoginModerator();
	    if(isset($view))
	        return $view;
	    $name = Input::get('name');
	    if(empty($name))
	    	return redirect()->route('categoria')->withErrors(['O campo não pode estar em branco']);
	    $categoria = new Categoria();
	    $categoria->name = $name;
	    $categoria->save();
	    Session::flash('success', 'Categoria criada com sucesso'); 
		return redirect()->route('categoria');
	}
	public function update($id){
	    $view = self::checkLoginModerator();
	    if(isset($view))
	        return $view;
	    $name = Input::get('name');
	    if(empty($name))
	    	return redirect()->route('categoria')->withErrors(['O campo não pode estar em branco']);
	    $c = Categoria::find($id);
	    $c->name = $name;
	    $c->update();
	    Session::flash('success', 'Categoria alterada com sucesso'); 
		return redirect()->route('categoria');
	}
	public function delete(){
	    $view = self::checkLoginModerator();
	    if(isset($view))
	        return $view;
    	$id = Input::get('id');
    	$count = \App\Post::where('categoria_id', $id)->count();
        if($count>0)
            return redirect()->back()->withErrors(['Existem postagens vinculadas a categoria','Não é possivel deletar']);
    	Categoria::destroy($id);
    	Session::flash('success', 'Categoria excluir com sucesso'); 
		return redirect()->route('categoria');
	}

}
