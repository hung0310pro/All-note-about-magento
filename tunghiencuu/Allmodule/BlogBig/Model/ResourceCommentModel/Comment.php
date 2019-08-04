<?php

namespace AHT\BlogBig\Model\ResourceCommentModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(Context $context)
	{
		parent::__construct($context);
	}

	public function _construct()
	{
		$this->_init('comment', 'id');
	}
}