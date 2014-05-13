<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home.index');  // views/home/index
});

Route::post('/', function()
{
	$url = Input::get('url');

	$v = Url::validate(array('url' => $url)); 
	if($v !== true)
	{
		return Redirect::to('/')->withErrors($v);
	}

	$record = Url::whereUrl($url)->first(); // metodos dinamicos ''whereUrl''
	if( $record)
	{
		return View::make('home.result')->with('shortened', $record->shortened);
	}

	

	$shortened = Url::get_unique_short_url();


	// se nao tiver cria um registro
	$row = Url::create(array(
		'url' => $url,
		'shortened' => $shortened)
	);

	// retorna a view com a url nova
	if( $row )
	{
		return View::make('home.result')->with('shortened', $row->shortened);
	}

	// se der pau na gravacao fazer o que?
});


Route::any('{shortened}', function($shortened)
{
	# TODO: quando a url nao tem HTTP na frente da pau
	// busca a url a partir da versao encurtada
	$row = Url::whereShortened($shortened)->first();

	//se o resultado for nulo manda pra pagina inicial	
	if( is_null($row) ) return Redirect::to('/');

	return Redirect::to($row->url);
});