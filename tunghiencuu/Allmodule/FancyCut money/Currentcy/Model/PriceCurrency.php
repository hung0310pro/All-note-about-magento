<?php

namespace FancyCut\Currentcy\Model;

use Magento\Framework\Pricing\PriceCurrencyInterface;

class PriceCurrency extends \Magento\Directory\Model\PriceCurrency implements PriceCurrencyInterface
{
    /**
     * @inheritdoc
     */
    const PRECISION_ZERO = 0;

    /**
     * {@inheritdoc}
     */
    public function format(
        $amount,
        $includeContainer = true,
        $precision = 0,
        $scope = null,
        $currency = null
    ) {
        return $this->getCurrency($scope, $currency)
            ->formatPrecision($amount, $precision, [], $includeContainer);
    }
}