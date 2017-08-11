<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Post;
use App\Categoria;
use Auth;
use Log;


class PostController extends Controller
{
    private $pageHolder = 6;

	public function posts(){
        $user = Auth::user();
        if(isset($user) && ($user->moderator || $user->author))
            $posts = Post::orderBy('created_at', 'desc')->limit($this->pageHolder)->get();
        else
            $posts = Post::where('active', 1)->orderBy('created_at', 'desc')->limit($this->pageHolder)->get();
        $top = null;
        $top = Post::where('destaque', 1)->where('active', 1)->orderBy('created_at', 'desc')->first();
        $dados = [
            'posts'=> $posts,
            'top'=> $top,
            'categorias'=>Categoria::all(),
            'pageHolder'=>$this->pageHolder,
            'categoriaId'=>null,
            'user'=>$user
        ];
        return view('post.posts', $dados);
    }

    public function categoria($categoria_id){
        $user = Auth::user();
        if(isset($user) && ($user->moderator || $user->author)){
            $posts = Post::where('categoria_id', $categoria_id)->
                           orderBy('created_at', 'desc')->
                           limit($this->pageHolder)->
                           get();
            $count = Post::where('categoria_id', $categoria_id)->
                           orderBy('created_at', 'desc')->
                           count();
        }else{
            $posts = Post::where('categoria_id', $categoria_id)->
                           where('active', 1)->
                           orderBy('created_at', 'desc')->
                           limit($this->pageHolder)->
                           get();
        
            $count = Post::where('categoria_id', $categoria_id)->
                           where('active', 1)->
                           orderBy('created_at', 'desc')->
                           count();
        }
        $categoria = Categoria::find($categoria_id);
        $categoria->view_count++;
        $categoria->update();
        $dados = [
            'top'=> null,
            'posts'=>$posts,
            'search_label'=>'A busca retornou '.$count.' resultado(s)',
            'categorias'=>Categoria::all(),
            'pageHolder'=>$this->pageHolder,
            'categoriaId'=>$categoria_id,
            'user'=>$user
        ];
        return view('post.posts', $dados);
    }

    public function post($key){
        $post = Post::where('key', $key)->first();
        if(!Auth::check()){
            $post->view_count++;
            $post->update();
        }
        if(!isset($post) || (!$post->active && !Auth::check()))
            return redirect()->to('/500');
        $dados = [
            'post'=>$post,
            'latest'=>Post::where('active', 1)->where('id','<>', $post->id)->orderBy('created_at','desc')->limit(3)->get(),
            'categorias'=>Categoria::all(),
            'user'=>Auth::user()
        ];
    	return view('post.detail', $dados);
    }

    public function add(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $files = $this->getUploadImages();
        $dados = [
            'files'=>$files,
            'post'=>new Post(),
            'categorias'=>self::montaCategoriasForm(),
            'user'=>Auth::user()
        ];
    	return view('admin.post.edit', $dados);
    }

    public function edit(){
    	$view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $id = Input::get('id');
        if(!isset($id))
            return redirect()->to('/500');
        $dados = [
            'post'=>Post::find($id),
            'categorias'=>self::montaCategoriasForm(),
            'user'=>Auth::user()
        ];
    	return view('admin.post.edit', $dados);
    }

    public function delete(){
    	$view = self::checkLoginModerator();
        if(isset($view))
            return $view;
    	$id = Input::get('id');
     	Post::destroy($id);
    	return redirect()->route('posts');
    }

    public function update($id){
    	$view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        
    	$post = Post::find($id);
    	$post->title = Input::get('title');
    	$post->descricao = Input::get('descricao');
    	$post->text = Input::get('text');
        $post->url_imagem = Input::get('url_imagem');
        $post->categoria_id = Input::get('categoria_id');
        $post->destaque = Input::get('destaque') || 0;
        $post->active = Input::get('active') || 0;
        $errors = Array();

        if(!empty($post->url_imagem) && strpos($post->url_imagem, "woobe.com.br")==false)
            array_push($errors, 'A URL da imagem não é válida');
        if(empty($post->categoria_id))
            array_push($errors, 'Escolha uma categoria');

        $files = $this->getUploadImages();
        $dados = [
            'files'=>$files,
            'post'=>$post,
            'categorias'=>self::montaCategoriasForm(),
            'user'=>Auth::user(),
            'erros'=>$errors
        ];
        if(count($errors) > 0)
            return view('admin.post.edit', $dados);
    	$post->update();
    	return redirect()->route('posts');
    }

    public function save(){
    	$view = self::checkLoginModerator();
        if(isset($view))
            return $view;
    	$title = Input::get('title');
    	$descricao = Input::get('descricao');
    	$text = Input::get('text');
        $urlImagem = Input::get('url_imagem');
        if(!empty($post->url_imagem) && strpos($post->url_imagem, "woobe.com.br")==false)
            return redirect()->back()->withInput()->withErrors(["A URL da imagem não é válida"]);
        $categoriaId = Input::get('categoria_id');
        if($categoriaId == "")
            return redirect()->back()->withInput()->withErrors(['Escolha uma categoria']);
        $userId = Input::get('user_id');
        $destaque = Input::get('destaque') || 0;
        $active = Input::get('active') || 0;
    	$key = str_random(30);

    	while(Post::where('key', $key)->count()>0){
			$key = str_random(30);
			// Gera nova chave, até não existir na tabela.    		
    	}

    	$post = new Post;
    	$post->title = $title;
    	$post->descricao = $descricao;
    	$post->text = $text;
    	$post->key = $key;
        $post->url_imagem = $urlImagem;
        $post->categoria_id = $categoriaId;
        $post->user_id = $userId;
        $post->destaque = $destaque;
        $post->active = $active;
    	$post->save();
    	return redirect()->route('posts');
    }

    public function changeStatus(){
        $view = self::checkLoginModerator();
        if(isset($view))
            return $view;
        $id = Input::get('post_id');
        $active = Input::get('active') || 0;
        $post = Post::find($id);
        $post->active = $active;
        $post->update();
        return redirect()->route('posts');
    }

    function montaCategoriasForm(){
        $listaCategorias = Categoria::all();
        $categorias = Array();
        foreach ($listaCategorias as $c) {
            $categorias[strval($c->id)] = $c->name;
        }
        return $categorias;
    }

    public function ajaxLoad(){
        $posts = Array();
        $index = Input::get('pageHolderControl');
        $categoriaId = Input::get('pageCategoryControl');
        if(isset($user) && ($user->moderator || $user->admin)){
            if(!empty($categoriaId)){
                $posts = Post::where('categoria_id', $categoriaId)->
                               orderBy('created_at', 'desc')->
                               take($this->pageHolder)->
                               skip($index)->
                               get();
            }
            else{
                $posts = Post::orderBy('created_at', 'desc')->take($this->pageHolder)->skip($index)->get();
            }
        }
        else{
            if(!empty($categoriaId)){
                $posts = Post::where('categoria_id', $categoriaId)->
                               where('active', 1)->
                               orderBy('created_at', 'desc')->
                               take($this->pageHolder)->
                               skip($index)->
                               get();
            }else{
                $posts = Post::where('active', 1)->orderBy('created_at', 'desc')->take($this->pageHolder)->skip($index)->get();
            }
        }
        return view('post.posts-ajax', ['posts'=>$posts, 'user'=>Auth::user()]);
    }

}
