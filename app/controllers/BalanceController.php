<?php

class BalanceController extends \BaseController {
	protected $layout = 'master';
	public function __construct()
	{
		$this->beforeFilter('auth');
		$this->beforeFilter('csrf', ['on' => 'post']);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->pagename = 'user';
		$this->layout->title = 'Histori Setoran Dana Nasabah';
		$this->layout->container = View::make('pages.balance.index')->with([
			'content_list' => BalanceHistory::paginate(20),
			'users' => User::where('usergroup_id',2)->get(),
		]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->pagename = 'user';
		$this->layout->title = 'Setor Dana Nasabah';
		$this->layout->container = View::make('pages.balance.add')->with('users',User::where('usergroup_id',2)->get());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(false),[
			'user_id'=> 'required',
			'amount'=> 'required',
		]);
		if($validator->passes()){
			$BalanceHistory = BalanceHistory::create([
				'user_id' => Input::get('user_id'),
				'amount' => Input::get('amount'),
			]);
			$User = User::find($BalanceHistory->user_id);
			$User->increment('balance',$BalanceHistory->amount);
			return Redirect::action('BalanceController@create')->with('success_msg',Lang::get('messages.successinsert').' Saldo Rekening a/n:'.$User->first_name.' Menjadi : '.$User->balance);
		}
		else{
			return Redirect::action('BalanceController@create')
				->withErrors($validator)
				->withInput();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		//
	}
	

}
