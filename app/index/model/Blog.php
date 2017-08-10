<?php
namespace index\model;
use csl\framework\Model;
class Blog extends Model
{
	public function blogList()
	{
		return $this->field('bid,title,create_time')->select();
	}
}