<?php
/**
 * Stussy_RelatedToColour
 *
 * @category  Catalog
 * @package   Stussy_RelatedToColour
 * @author    Convert Digital
 * @copyright 2019 Convert Digital
 * @version   1.0.0
 *
 */
namespace Stussy\RelatedToColour\Plugin\ProductList;

use Magento\Catalog\Block\Product\ProductList\Related as Subject;
use Magento\Framework\Registry;

/**
 * Class Related
 *
 * @package Stussy\RelatedToColour\Plugin\ProductList
 */
class Related
{
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Related constructor.
     *
     * @param Registry $coreRegistry
     */
    public function __construct(Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
    }

    /**
     * @param Subject $subject
     * @param callable $proceed
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function aroundGetItems(Subject $subject, callable $proceed)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $items */
        $items = $proceed();
        $product = $this->_coreRegistry->registry('product');
        if ($product && $product->getData('colour_by_related')) {
            $items->addAttributeToFilter('entity_id', 0);
        }
        return $items;
    }
}