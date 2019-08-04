<?php

namespace AHT\BlogBig\Block;

use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;
use Magento\Framework\View\Element\Template;
use AHT\BlogBig\Model\ResourceCategoryModel\Category\CollectionFactory;

class MyMenu extends \Magento\Theme\Block\Html\Topmenu
{
	protected $_collectionFactory;

	// hàm construct phải khai báo đầy đủ như bên Topmenu
	public function __construct(Template\Context $context, NodeFactory $nodeFactory, TreeFactory $treeFactory, array $data = [], CollectionFactory $collectionFactory)
	{
		$this->_collectionFactory = $collectionFactory;
		parent::__construct($context, $nodeFactory, $treeFactory, $data);
	}

	// lấy dữ category để đổ vào hàm getHtml.
	public function getListCt()
	{
		$model = $this->_collectionFactory->create();
		$mang = $model->getData();
		return $mang;
	}

	// thực hiện nối chuỗi Menu của mình và chuỗi Menu của nó
	public function getHtml($outermostClass = '', $childrenWrapClass = '', $limit = 0)
	{
		$myChuoi = '';
		$myChuoi .= '<li  class="level0 nav-3 category-item level-top parent"><a href="#"  class="level-top" >Mymenu';
		$myChuoi .= '<ul class="level0 submenu">';
		foreach ($this->getListCt() as $value) {
			$myChuoi .= '<li class="level1 nav-4-1 category-item first">';
			$myChuoi .= '<a href="' . $this->getUrl("portfolio-category-" . $value['id'] . "") . '">';
			$myChuoi .= $value['namecategory'];
			$myChuoi .= '</a>';
			$myChuoi .= '</li>';
		}
		$myChuoi .= "</ul>";
		$myChuoi .= "</li>";


		$this->_eventManager->dispatch(
			'page_block_html_topmenu_gethtml_before',
			['menu' => $this->getMenu(), 'block' => $this, 'request' => $this->getRequest()]
		);

		$this->getMenu()->setOutermostClass($outermostClass);
		$this->getMenu()->setChildrenWrapClass($childrenWrapClass);

		$html = $this->_getHtml($this->getMenu(), $childrenWrapClass, $limit);

		$transportObject = new \Magento\Framework\DataObject(['html' => $html]);
		$this->_eventManager->dispatch(
			'page_block_html_topmenu_gethtml_after',
			['menu' => $this->getMenu(), 'transportObject' => $transportObject]
		);
		$html = $transportObject->getHtml();
		return $html . $myChuoi;
	}

}
