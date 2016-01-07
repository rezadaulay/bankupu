<?php

class UserController extends \BaseController {
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
		$this->layout->title = 'Daftar Nasabah';
		$this->layout->container = View::make('pages.user.index')->with([
			'content_list' => User::where('usergroup_id',2)->paginate(20),
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
		$this->layout->title = 'Tambah Nasabah';
		$this->layout->container = View::make('pages.user.add');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::all(false),[
			'email'=> 'required|email',
			'first_name'=> 'required',
			'tanggal_lahir'=> 'required',
			'no_ktp'=> 'required',
			'sex'=> 'required',
			'no_rek'=> 'required',
		]);
		if($validator->passes()){
			$User = User::create([
				'username' => null/* Input::get('username') */,
				'email' => Input::get('email'),
				'password' => Hash::make(Input::get('password')),
				'usergroup_id' => 2,
				'first_name' => Input::get('first_name'),
				'last_name' => '',
				'sex' => Input::get('sex'),
				'no_rek' => Input::get('no_rek'),
				'npwp' => Input::get('npwp'),
				'tanggal_lahir' => Input::get('tanggal_lahir'),
				'no_ktp' => Input::get('no_ktp'),
				'activated' => 1,
				'expirebandate' => null,
			]);
			return Redirect::action('UserController@create')->with('success_msg',Lang::get('messages.successinsert'));
		}
		else{
			return Redirect::action('UserController@create')
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
		$this->layout->pagename = 'user';
		$this->layout->title = 'Ubah Data Nasabah';
		$this->layout->container = View::make('pages.user.edit')->with([
			'detail' => User::find($id), 
		]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$validator = Validator::make(Input::all(false),[
			'email'=> 'required|email',
			'first_name'=> 'required',
			'tanggal_lahir'=> 'required',
			'no_ktp'=> 'required',
			'sex'=> 'required',
			'no_rek'=> 'required',
		]);
		if($validator->passes()){
			$user->update([
				'email' => Input::get('email'),
				'first_name' => Input::get('first_name'),
				'sex' => Input::get('sex'),
				'no_rek' => Input::get('no_rek'),
				'npwp' => Input::get('npwp'),
				'tanggal_lahir' => Input::get('tanggal_lahir'),
				'no_ktp' => Input::get('no_ktp'),
			]);
			return Redirect::back()->with('success_msg',Lang::get('messages.successupdate'));
		}
		else{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		$id = Input::get('id.0');
		$avatar_img = null;
		if (sizeof($id) > 0){
			$User = User::find($id);
			DB::beginTransaction();
			try
			{
				$User->delete();
				DB::commit();
				if (!is_null($avatar_img) && File::exists(Config::get('user.upload_user_ava_directory').$avatar_img)){
					File::delete(Config::get('user.upload_user_ava_directory').$avatar_img);
				}
				return Redirect::back()->with('success_msg',Lang::get('messages.successdelete'));
				
			}
			catch(\Exception $e)
			{
				DB::rollback();
				return Redirect::back()->with('error_msg', $e->getMessage() );
			}
			return Redirect::back()->with('error_msg','You Don\'t have access to delete it');
		}
	}
	

}
