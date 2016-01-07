<?php

class SessionController extends \BaseController {
	protected $user;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', ['only' =>['logout','update']]);
        $this->beforeFilter('guest', ['only' =>['index','store']]);
	} 
	public function errorpage()
	{
		return View::make('pages.error');
	}
	public function index()
	{
		return View::make('login');
	}
	public function store()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		$validator = Validator::make(Input::all(),[
			"username"=> "required",
			"password"=> "required",
			/* "g-recaptcha-response"=> (LoginprocesLog::WithCaptcha())? 'required|recaptcha' : '' , */
		]);
		if($validator->passes()){
			try
			{
					$user = $this->user->authenticate($username,$password,false);
					return Redirect::route('backend_home');
			}
			catch (UsersInactiveException $e)
			{
				return Redirect::action('SessionController@index')->with('login_errors',Lang::get('validation.not_active_user'));
			}
			catch (UsersBannedException $e)
			{
				return Redirect::action('SessionController@index')->with('login_errors',Lang::get('validation.banned_user'));
			}
			catch (UsersWrongpassException $e)
			{
				return Redirect::action('SessionController@index')->with('login_errors',Lang::get('validation.login_error'));
			}
			catch (UsersIpBannedException $e)
			{
				return Redirect::action('SessionController@index')->with('login_errors',Lang::get('validation.login_error'));
			}
			catch(\Exception $e)
			{
				return Redirect::action('SessionController@index')
					->withInput()
					->with('login_errors',Lang::get('validation.login_error'));
			}
		}
		else{
			return Redirect::action('SessionController@index')
					->withErrors($validator)
					->withInput();
		}
	}

	public function update($id)
	{
		if(Auth::id() != $id)
			return Redirect::to('http://google.com');

		$user = Auth::User();
		$validator = Validator::make(Input::all(false),[
			/* 'username'=> 'required|min:5|unique:users,username,'.$id, */
			'email'=> 'required|email|unique:users,email,'.$id,
			'password'=> 'min:5|confirmed:password_confirmation',
			'first_name'=> 'required',
			'last_name'=> 'required',
			/* 'sex'=> 'required', */
			/* 'avatar_img'=> 'image|max:90', */
		]);
		if($validator->passes()){
			$img_ava = $user->avatar_img;
			$password = Input::get('password');
			if (Input::hasFile('avatar_img'))
			{
				if (File::exists(Config::get('user.upload_user_ava_directory').$img_ava)){
					File::delete(Config::get('user.upload_user_ava_directory').$img_ava);
				}
				if(!is_dir( Config::get('user.upload_user_ava_directory') )){
					File::makeDirectory(Config::get('user.upload_user_ava_directory'),0755,true);
				}
				$img = Image::make(Input::file('avatar_img'));
				$img_ava = md5(Input::get('username')).'.'.Input::file('avatar_img')->getClientOriginalExtension();
				if( $img->width() < $img->height() )
					$img->resize(100, null, function ($constraint) {$constraint->aspectRatio();})->crop(100, 100)->save(Config::get('user.upload_user_ava_directory').$img_ava,90);
				else
					$img->resize(null, 100, function ($constraint) {$constraint->aspectRatio();})->crop(100, 100)->save(Config::get('user.upload_user_ava_directory'). $img_ava,90);
			}
			$user->update([
				'username' => null/* Input::get('username') */,
				'email' => Input::get('email'),
				'password' => (!empty($password)) ? Hash::make($password) : $user->password,
				'first_name' => Input::get('first_name'),
				'last_name' => Input::get('last_name'),
				/* 'sex' => Input::get('sex'), */
				/* 'avatar_img' => $img_ava, */
			]);
			return Redirect::back()->with('success_msg',Lang::get('messages.successupdate'));
		}
		else{
			return Redirect::back()
				->withErrors($validator)
				->withInput();
		}
	}

	public function logout()
	{
		$this->user->logout();
		return Redirect::route('backend_home');
	}

}
