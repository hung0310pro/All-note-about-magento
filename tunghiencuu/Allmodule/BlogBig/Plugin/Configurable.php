<?php

namespace AHT\BlogBig\Plugin;

class Configurable
{
	/**
	 * getAllowProducts
	 *
	 * @param \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject
	 *
	 * @return array
	 */

/*	You can use before methods to change the arguments of an observed method by returning a modified argument. If there is more than one argument, the method should return an array of those arguments. If the method does not change the argument for the observed method, it should return null.*/

	public function beforeGetAllowProducts($subject)
	{
		if (!$subject->hasData('allow_products')) {
			$products = [];
			$allProducts = $subject->getProduct()->getTypeInstance()->getUsedProducts($subject->getProduct(), null);
			foreach ($allProducts as $product) {
				$products[] = $product;
			}
			$subject->setData('allow_products', $products);
		}

		return [];
	}



}