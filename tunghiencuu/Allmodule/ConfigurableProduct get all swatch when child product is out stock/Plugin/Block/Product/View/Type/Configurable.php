<?php
/**
 * Stussy_ConfigurableProduct
 *
 * @category  Catalog
 * @package   Stussy_ConfigurableProduct
 * @author    Convert Digital
 * @copyright 2019 Convert Digital
 * @version   1.0.0
 *
 */
namespace Stussy\ConfigurableProduct\Plugin\Block\Product\View\Type;

/**
 * Class Configurable
 *
 * @package Stussy\ConfigurableProduct\Plugin\Block\Product\View\Type
 */
class Configurable
{
    /**
     * Get Allowed Products
     *
     * @return \Magento\Catalog\Model\Product[]
     */
    public function afterGetAllowProducts(
        \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject,
        $result
    )
    {
        $products = [];
        $allProducts = $subject->getProduct()->getTypeInstance()->getUsedProducts($subject->getProduct(), null);
        foreach ($allProducts as $product) {
            $products[] = $product;
        }
        return $products;
    }
}