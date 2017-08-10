<?php
namespace index\controller;
use index\controller\BaseController;
use index\model\Blog;

class IndexController extends BaseController
{
	protected $blog;

	public function _init()
	{
		$this->blog = new Blog();
	}
	public function index()
	{
		$data = $this->blog->blogList();
		$this->assign('data',$data);
		
		// var_dump($this);
		//模板名称和当前方法名称一致
		// $this->display('index/index.html',true);
		$this->display();
	}
	
}