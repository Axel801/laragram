<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{


	public function config(){

		return view('user.config');

	}

	public function update(Request $request){
		$name = $request->input('name');
		$surname = $request->input('surname');
		$nick = $request->input('nick');
		$email = $request->input('email');
		$id = \Auth::user()->id;//Obtenemos el ID del usuario logueaddo, se usa el \ porque no lo tenemos declarado como namespace


	}
}
