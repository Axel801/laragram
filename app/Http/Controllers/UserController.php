<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Http\Response;
	use Illuminate\Support\Facades\Storage;
	use Illuminate\Support\Facades\File;

	class UserController extends Controller
	{
		//Para que nada más podamos acceder a este controlador si estamos logueados
		public function __construct ()
		{
			$this->middleware('auth');
		}

		public function config ()
		{

			return view( 'user.config' );

		}

		public function update ( Request $request )
		{

			//Conseguir el usuario identificado
			$user = \Auth::user();// se usa el \ porque no lo tenemos declarado como namespace
			$id = $user->id;//Obtenemos el ID del usuario logueaddo

			//Validamos el formulario
			$validate = $this->validate( $request, [
				'name' => 'required|string|max:255',
				'surname' => 'required|string|max:255',
				'nick' => 'required|string|max:255|unique:users,nick,'.$id,//Indicamos que el nick tiene que ser unico, pero que no de error si el nick es del usuario logueado
				//Si ponemos solo 'unique:users' al intentar actualizar el usuario diría que ese nick ya existe
				'email' => 'required|string|email|max:255|unique:users,email,'.$id,
			] );

			//Recogemos los datos del formulario
			$name = $request->input( 'name' );
			$surname = $request->input( 'surname' );
			$nick = $request->input( 'nick' );
			$email = $request->input( 'email' );

			$user->name = $name;
			$user->surname = $surname;
			$user->nick = $nick;
			$user->email = $email;

			//Subir avatar

			$image_path = $request->file('image_path');//Obtenemos la imagen que se ha enviado, similar a $_FILE
			if($image_path){
				$image_path_name = time().$image_path->getClientOriginalName();//Creamos un nombre único para que se guarde en el servidor
				//Guarda en la carpeta storage (storage/app/users)
				Storage::disk('users')->put($image_path_name, File::get($image_path));
				//Seteo el nombre de la imagen en el objeto
				$user->image = $image_path_name;
			}

			//Ejecutamos los cambios
			$user->update();
			return redirect()->route('config')
							 ->with(['message'=>'Usuario actualizado correctamente']);
		}

		//Creamos un metodo para que imprima la imagen en crudo en una URL
		public function getImage($filename){
			$file = Storage::disk('users')->get($filename);
			return new Response($file,200);
		}
	}
