<?php

namespace AHT\BlogBig\Model;

class Comment extends \Magento\Framework\Model\AbstractModel

{
	public function _construct()
	{
		$this->_init("AHT\BlogBig\Model\ResourceCommentModel\Comment");
	}

}