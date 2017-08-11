<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Categoria;
use App\Post;
use App\User;
use DB;
use Log;

class ApiController extends Controller
{
    public function posts(Request $request){
    	$dados = $this->validateRequest($request);
    	if(isset($dados))
            return $dados;
        try{
            $user_id = (int)$request->input('author_id');
            $categoria_id = (int)$request->input('category_id');
            $retorno = Post
            		::join('categorias', 'categorias.id', '=', 'posts.categoria_id')
            		->join('users', 'users.id', '=', 'posts.user_id')
            		->select('posts.id as post_id','posts.title as post_title','posts.descricao as post_description','posts.key as post_key','posts.url_imagem as post_url_image','posts.view_count as post_views','posts.destaque as post_featured','posts.active as post_active','posts.created_at as post_created_date',
            			'categorias.id as category_id','categorias.name as category_name',
            			'users.id as user_id', 'users.name as user_name', 'users.email as user_email')
            		->orderBy('posts.created_at', 'desc')
            		->get();
    		$posts = Array();
            $active_count = 0;
            foreach ($retorno as $p) {
                $add = false;
                if($categoria_id != "" && $categoria_id == $p->category_id && $user_id != "" && $user_id == $p->user_id){
                    $add = true;
                }else if($categoria_id != "" && $categoria_id == $p->category_id && $user_id == ""){
                    $add = true;
                }else if($user_id != "" && $user_id == $p->user_id && $categoria_id == ""){
                	$add = true;
                }else if($categoria_id == "" && $user_id == ""){
                    $add = true;
                }

                if($add){
                    $obj = $this->montarJsonPost($p);
                    array_push($posts, $obj);
                    if($p->post_active) $active_count++;
                }
            }
            $dados = [
                'active_count'=>$active_count,
                'total_count'=>count($posts),
                'posts'=> $posts,
            ];
        }catch(\Exception $e){
            $dados = ['error'=>true, 'description'=>utf8_encode($e->getMessage())];
        }
        return $dados;
    }
    public function authors(Request $request){
        $dados = $this->validateRequest($request);
        if(isset($dados))
            return $dados;
        try{
            $retorno =  DB::select('SELECT u.id, u.name, u.email, u.last_login, u.created_at, u.updated_at, SUM(p.active) AS active_post_count, COUNT(p.id) AS total_post_count FROM users u LEFT JOIN posts p ON p.user_id = u.id GROUP BY u.id ORDER BY u.name ASC');
            $authors = Array();
            foreach ($retorno as $a) {
                $d = [
                    "id"=>$a->id,
                    "name"=>$a->name,
                    "email"=>$a->email,
                    "last_login"=>($a->last_login == null)?"":$a->last_login,
                    "created_date"=>$a->created_at,
                    "updated_date"=>$a->updated_at,
                    "active_post_count"=>($a->active_post_count == null)?'0':$a->active_post_count,
                    "total_post_count"=>($a->total_post_count == null)?'0':$a->total_post_count
                ];
                array_push($authors, $d);
            }
            $dados = [
                'authors'=>$authors
            ];
        }catch(\Exception $e){
            $dados = ['error'=>true, 'description'=>utf8_encode($e->getMessage())];
        }
        return $dados;
    }
    public function categories(Request $request){
        $dados = $this->validateRequest($request);
        if(isset($dados))
            return $dados;
        try{
            $dados = ['categories'=>Categoria::all(['id', 'name','view_count as views', 'created_at as created_date', 'updated_at as updated_date'])];
        }catch(\Exception $e){
            $dados = ['error'=>true, 'description'=>utf8_encode($e->getMessage())];
        }
        return $dados;
    }
    public function stats(Request $request){
        $dados = $this->validateRequest($request);
        if(isset($dados))
            return $dados;
        try{
            $p = Post
        		::join('categorias', 'categorias.id', '=', 'posts.categoria_id')
        		->join('users', 'users.id', '=', 'posts.user_id')
        		->select('posts.id as post_id','posts.title as post_title','posts.descricao as post_description','posts.key as post_key','posts.url_imagem as post_url_image','posts.view_count as post_views','posts.destaque as post_featured','posts.active as post_active','posts.created_at as post_created_date',
        			'categorias.id as category_id','categorias.name as category_name',
        			'users.id as user_id', 'users.name as user_name', 'users.email as user_email')
        		->where('posts.view_count', '<>', 0)->orderBy('posts.view_count', 'desc')
        		->first();
        	$dados_post = null;
            if(isset($p)){
    	        $dados_post = [
            		'id'=>$p->post_id,
            		'title'=>$p->post_title,
            		'description'=>$p->post_description,
            		'key'=>$p->post_key,
            		'url_image'=>$p->post_url_image,
            		'views'=>$p->post_views,
            		'featured'=>boolval($p->post_featured),
            		'active'=>boolval($p->post_active),
            		'created_date'=>$p->post_created_date,
            		'author'=>['id'=>$p->user_id,'name'=>$p->user_name,'email'=>$p->user_email],
            		'category'=>['id'=>$p->category_id,'name'=>$p->category_name]
            	];
    	    }
            $categoria = Categoria::where('view_count', '<>', 0)->orderBy('view_count','desc')->first(['id', 'name', 'view_count as views']);
            $a = DB::select('SELECT u.id, u.name, u.email, sum(p.active) as active_post_count, count(p.id) as total_post_count from users u inner join posts p on p.user_id = u.id group by u.id');
            $dados = [
            	'top_view_post'=>$dados_post,
            	'top_view_category'=>$categoria,
            	'author_list'=>$a
            ];
        } catch(\Exception $e){
            $dados = ['error'=>true, 'description'=>utf8_encode($e->getMessage())];
        }
        return $dados;
    }

    function validateRequest($request){
    	$APP_KEY = $request->input('APP_KEY');
    	$SERVER_KEY = env('APP_KEY');
    	if($SERVER_KEY !== $APP_KEY)
			return ['error'=>true,'description'=>'Access denied'];
    }

    function montarJsonPost($p){
        return $obj = [
            'id'=>$p->post_id,
            'title'=>$p->post_title,
            'description'=>$p->post_description,
            'key'=>$p->post_key,
            'url_image'=>$p->post_url_image,
            'views'=>$p->post_views,
            'featured'=>boolval($p->post_featured),
            'active'=>boolval($p->post_active),
            'created_date'=>$p->post_created_date,
            'author'=>['id'=>$p->user_id,'name'=>$p->user_name,'email'=>$p->user_email],
            'category'=>['id'=>$p->category_id,'name'=>$p->category_name]
        ];
    }
}
