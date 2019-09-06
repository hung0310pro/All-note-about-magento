<?php

namespace FancyCut\PriceDecimal\Plugin\Framework\Pricing;

class Currency
{
    /**
     * @var \FancyCut\PriceDecimal\Helper\Data
     */
    protected $priceDecimalHelperData;

    /**
     * @param \FancyCut\PriceDecimal\Helper\Data $priceDecimalHelperData
     */
    public function __construct(
        \FancyCut\PriceDecimal\Helper\Data $priceDecimalHelperData
    ) {
        $this->priceDecimalHelperData = $priceDecimalHelperData;
    }

    /**
     * {@inheritdoc}
     *
     * @param \Magento\Framework\CurrencyInterface $subject
     * @param array $args
     *
     * @return array
     */
    public function beforeToCurrency(
        \Magento\Framework\CurrencyInterface $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                $args[1]['precision'] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                $args[1]['precision'] = 0;
            }
        }

        return $args;
    }
}
