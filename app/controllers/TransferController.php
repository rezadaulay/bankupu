<?php

class TransferController extends \BaseController {
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
		$this->layout->title = 'Histori Transfer Antar Nasabah';
		$this->layout->container = View::make('pages.transfer.index')->with([
			'content_list' => TransferHistory::paginate(20),
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
		$this->layout->title = 'Transfer Antar Nasabah';
		$this->layout->container = View::make('pages.transfer.add')->with('users',User::where('usergroup_id',2)->get());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(false),[
			'from_user'=> 'required',
			'to_user'=> 'required',
			'amount'=> 'required',
		]);
		if($validator->passes()){
			$TransferHistory = TransferHistory::create([
				'from_user' => Input::get('from_user'),
				'to_user' => Input::get('to_user'),
				'amount' => Input::get('amount'),
			]);
			User::find($TransferHistory->from_user)->decrement('balance',$TransferHistory->amount);
			User::find($TransferHistory->to_user)->increment('balance',$TransferHistory->amount);
			return Redirect::action('TransferController@create')->with('success_msg','Tranfer Dana Berhasil Dilakukan');
		}
		else{
			return Redirect::action('TransferController@create')
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
