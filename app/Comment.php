<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Comment extends Model
	{
		//Modelo de la tabla 'Images'
		protected $table = 'comments';

		//Relacion Many To One
		public function user ()
		{
			//Se pasa la ruta del modelo al que queremos hacer referencia
			return $this->belongsTo( 'App\User', 'user_id' );
		}

		//Relacion Many To One
		public function image ()
		{
			//Se pasa la ruta del modelo al que queremos hacer referencia
			return $this->belongsTo( 'App\Image', 'image_id' );
		}
	}
