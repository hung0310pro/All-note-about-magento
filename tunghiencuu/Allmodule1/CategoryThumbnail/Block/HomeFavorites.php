<?php

namespace Convert\CategoryThumbnail\Block;

class HomeFavorites extends \Magento\Framework\View\Element\Template {
  protected $_categoryFactory;    

  public function __construct(
    \Magento\Catalog\Model\CategoryFactory $categoryFactory,
    \Magento\Framework\View\Element\Template\Context $context
  ) {
      $this->_categoryFactory = $categoryFactory;
      parent::__construct($context);
  }

  public function getCategoryFavorites($cat_id)
  {
      $category = $this->_categoryFactory->create()->load($cat_id);
      return $category;
  }
}