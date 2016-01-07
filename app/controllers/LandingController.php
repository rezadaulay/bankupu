<?php

class LandingController extends \BaseController {
	protected $layout = 'master';
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()){
			$this->layout->pagename = 'homepage';
			$this->layout->title = 'Admin Area';
			$this->layout->container = View::make('pages.index');
		}
		else{
			return Redirect::to('login');
		}
	}
	public function error()
	{
		$this->layout->pagename = 'error';
		$this->layout->title = '404 Not Found';
		$this->layout->container = View::make('pages.error');
	}

}
