<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	//Modelo de la tabla 'Images'
    protected $table = 'images';

    //Relacion One To Many
	public function comments(){
		//Permite obtener los datos relacionados con el objeto de la tabla 'Comments'
		//Se pasa la ruta del modelo al que queremos hacer referencia
		return $this->hasMany('App\Comment');
	}

	//Relacion One To Many
	public function likes(){
		return $this->hasMany('App\Like');
	}

	//Relacion Many To One
	public function user(){
		//Se pasa la ruta del modelo al que queremos hacer referencia
		return $this->belongsTo('App\User','user_id');
	}
}
