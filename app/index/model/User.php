<?php
namespace index\model;
use csl\framework\Model;

class User extends Model
{
	public function checkLogin($username,$password)
	{
		$password = md5($password);
		return $this->where("name='$username' and password='$password'")
					 ->limit('1')
					 ->field('uid,name,type')
					 ->select();
	}

	public function usernameRepeat($username)
	{
		$data =  $this->where("name='$username'")->select();
		//1如果用户存在返回true，否则返回fale
		return !empty($data[0]);
	}
}