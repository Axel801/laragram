<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Like extends Model
	{
		protected $table = 'likes';

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
