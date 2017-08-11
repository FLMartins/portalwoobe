<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    /**
     * Get the User for this post.
     */
    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }

    /**
     * Get the Categoria for this post.
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria')->first();
    }

    /**
     * Get the created date formatted for initial page
     */
    function getFormattedCreatedDate()
    {
        return $this->created_at->format('d/m/y');
    }

     /**
     * Get the created date formatted with time
     */
    function getFormattedCreatedDateTime()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    /**
     * Get the created date formatted for detail page
     */
    function getFormattedCreatedDateExtended()
    {
        return $this->created_at->format('d')." de ".$this->getMes_ptBR((int) $this->created_at->format('m') )." de ".$this->created_at->format('Y') ;
    }

    function getMes_ptBR($mes_int){
        switch ($mes_int) {
            case 1:
                return 'Janeiro';
                break;
            case 2:
                return 'Fevereiro';
                break;
            case 3:
                return 'Março';
                break;
            case 4:
                return 'Abril';
                break;
            case 5:
                return 'Maio';
                break;
            case 6:
                return 'Junho';
                break;
            case 7:
                return 'Julho';
                break;
            case 8:
                return 'Agosto';
                break;
            case 9:
                return 'Setembro';
                break;
            case 10:
                return 'Outubro';
                break;
            case 11:
                return 'Novembro';
                break;
            case 12:
                return 'Dezembro';
                break;
            default:
                return "";
                break;
        }
    }
}

