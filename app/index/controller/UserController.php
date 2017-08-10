<?php
namespace index\controller;
use index\controller\BaseController;
use csl\framework\VerifyCode;
use index\model\User;
class UserController extends BaseController
{
	protected $user;

	public function _init()
	{
		$this->user = new User();
	}
	public function login()
	{
		$this->display();
	}

	public function yzm()
	{
		$vc = new VerifyCode();
		$vc->outputImage();
		$_SESSION['code'] = $vc->getCode();
	}

	/**
	 * 登录处理
	 * @return [type] [description]
	 */
	public function doLogin()
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$code = $_POST['code'];
		$result = $this->user->checkLogin($username,$password)[0];
		var_dump($result);
		if ($result && count($result)>0) {
			if ($code == $_SESSION['code']) {
				unset($_SESSION['code']);
				$_SESSION['username'] = $username;
				$_SESSION['type'] = $result['type'];
				// var_dump($_SESSION);die;
				$this->success('登录成功！','http://localhost/1707/high/9/blog/');
			} else {
 				$this->error('验证码错误');
			}
		} else {
			$this->error('登录失败');
		}
	}

	public function logout()
	{
		unset($_SESSION['username']);
		unset($_SESSION['type']);
		$this->success('退出成功','http://localhost/1707/high/9/blog/');
		// $this->display('index/index.html');
	}

	public function register()
	{
		$this->display();
	}
	public function doRegister()
	{
		// var_dump($_POST);
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		$email = $_POST['email'];

		//1 用户名是否重复
		if ($this->user->usernameRepeat($username)) {
			$this->error('用户名重复');
		}
	}
}

