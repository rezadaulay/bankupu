<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('is_ajax', function()
{
	if (!Request::ajax()) 
		return Response::json('You don\'t have access to this page !',401);
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	if (Session::token() !== $token) {
		if (Request::ajax()) 
			return Response::json('You don\'t have access to this page !',401);
		else
			throw new Illuminate\Session\TokenMismatchException;
	}
});


Route::filter('is_mobile', function()
{return true;
	return Agent::isDesktop()? false : true ;
});

Route::filter('hasAccess', function($route, $request, $value){
	try
	{
		if( ! User::hasAccess($value))
		{
			 if (!Request::is('manage') && !Request::is('manage/*'))
			{
				if ( Request::ajax() )
					return Response::json('You don\'t have access to this page !',401);
				else
					return Redirect::to('/')->with('error_msg','You don\'t have access to this page !');
			}
			else{
				if ( Request::ajax() )
					return Response::json('You don\'t have access to this page !',401);
				else
					return Redirect::action('SessionController@index')->with('error_msg','Anda Tidak Memiliki Akses Ke Halaman Tersebut.');
			} 
			/* if ( Request::ajax() )
				return Response::json('You don\'t have access to this page !',401);
			else
				return Redirect::to('/')->with('error_msg','Anda Tidak Memiliki Akses Ke Halaman Tersebut.'); */
		}
	}
	catch(\Exception $e)
	{
		if ( Request::ajax() )
			return Response::json( $e->getMessage() ,401);
		else
			return Redirect::to('/')->with( $e->getMessage() );
	}
 
});