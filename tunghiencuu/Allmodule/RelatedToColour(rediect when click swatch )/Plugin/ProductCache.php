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
namespace Stussy\RelatedToColour\Plugin;

use Magento\Framework\App\CacheInterface;
use Magento\Catalog\Model\Product;

/**
 * Class ProductCache
 *
 * @package Stussy\RelatedToColour\Plugin
 */
class ProductCache
{
    /**
     * @var CacheInterface
     */
    protected $_cacheManager;

    /**
     * ProductCache constructor.
     *
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->_cacheManager = $cache;
    }

    /**
     * @param Product $subject
     * @param callable $proceed
     * @return mixed
     */
    public function aroundCleanCache(Product $subject, callable $proceed)
    {
        $ids = $subject->getRelatedProductIds();
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $this->clearProductCache($id);
            }
        }
        return $proceed();
    }

    /**
     * @param $id
     */
    protected function clearProductCache($id)
    {
        $this->_cacheManager->clean('catalog_product_' . $id);
    }
}