<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
/* use Illuminate\Database\Eloquent\SoftDeletingTrait; */
/* class User extends Eloquent implements RemindableInterface { */
class User extends Eloquent implements UserInterface, RemindableInterface {
	/* use SoftDeletingTrait; */
	use RemindableTrait;
	public function getKelaminAttribute()
	{
		if( $this->sex == 'man' ){
			return 'Pria';
		}
		else{
			return 'Wanita';
		}
	}
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	/* protected $table = 'users';
 */
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'],$dates = ['deleted_at'],$guarded = ['id'];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}
	

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public function authenticate($username,$password,$rememberme=false){
		if(str_contains($username, '@'))
		{
			$user = self::/* with('usergroup')-> */where('email','=',$username)->where('usergroup_id',1)->first();
		}
		else
		{
			$user = self::/* with('usergroup')-> */where('username','=',$username)->where('usergroup_id',1)->first();
		}
		if(!is_null($user)){
			if (Auth::attempt(array('email' => $user->email, 'password' => $password),$rememberme))
			{
				if($user->activated === '2'){
					self::logout();
					throw new UsersInactiveException();
				}
				else if($user->activated === '3' && strtotime($user->expirebandate) > time() ){
					self::logout();
					throw new UsersBannedException();
				}
				/* Auth::loginUsingId($user->id); */
				Session::forget('user_role');
				$allroles = [];
				/* $user->usergroup->roles->each(function($role)
				{
					Session::push('user_role.'.$role->name, true);
				}); */
				$user->last_login = date('Y-m-d H:i:s');
				$user->save();
				/* $ip   = $_SERVER['REMOTE_ADDR'];
				$long = ip2long($ip);
				$LoginprocesLog = LoginprocesLog::where('ip',sprintf('%u', $long))->first(['ip','login_failed_count','expirebandate']);
				if(!is_null($LoginprocesLog)){
					$LoginprocesLog->delete();
				}
				Cache::forget('login_proc_'.$long); */
				return $user;
			}			
		} 
			/* echo long2ip($ip_); */
			/* $ip   = $_SERVER['REMOTE_ADDR'];
			$long = ip2long($ip);
			if ($long != -1 && $long !== FALSE){
				$ip_ = sprintf('%u', $long);
				$LoginprocesLog = LoginprocesLog::where('ip',$ip_)->first(['ip','login_failed_count','expirebandate']);
				if(is_null($LoginprocesLog)){
					LoginprocesLog::create([
						'ip'=> $ip_ ,
						'login_failed_count'=> 1 ,
					]);
				}
				else{
					if($LoginprocesLog->login_failed_count >= Config::get('user.max_fail_login')){
						if(!is_null($LoginprocesLog->expirebandate)){
							if(($LoginprocesLog->expirebandate < time())){
								Cache::forget('login_proc_'.$long);
								throw new UsersIpBannedException();
							}
							else{
								$LoginprocesLog->update([
									'login_failed_count'=> 1 ,
									'expirebandate'=> null,
								]);
							}
						}
						else{
							$expirebandate = date('Y-m-d H:i:s', strtotime(Config::get('user.banned_expired')));
							$LoginprocesLog->update([
								'expirebandate'=> $expirebandate,
							]);
							Cache::forget('login_proc_'.$long);
							throw new UsersIpBannedException();
						}
					}
					else
						$LoginprocesLog->increment('login_failed_count');
				}
			} */
			throw new UsersWrongpassException();
	}
	
	public function logout(){
		Session::forget('user_role');
		return Auth::logout();
	}
	
}
