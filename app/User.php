<?php

	namespace App;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable
	{
		use Notifiable;

		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'role','name','surname','nick', 'email', 'password',
		];

		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password', 'remember_token',
		];


		//Relacion One To Many
		public function images ()
		{
			//Se pasa la ruta del modelo al que queremos hacer referencia
			return $this->hasMany( 'App\Images' );
		}
	}
