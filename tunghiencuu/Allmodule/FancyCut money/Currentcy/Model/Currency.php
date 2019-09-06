<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace FancyCut\Currentcy\Model;

/**
 * Currency model
 *
 * @api
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Currency extends \Magento\Directory\Model\Currency
{
    

    /**
     * Apply currency format to number with specific rounding precision
     *
     * @param   float $price
     * @param   int $precision
     * @param   array $options
     * @param   bool $includeContainer
     * @param   bool $addBrackets
     * @return  string
     */
    public function formatPrecision(
        $price,
        $precision,
        $options = [],
        $includeContainer = true,
        $addBrackets = false
    ) {
        if (!isset($options['precision'])) {
            $options['precision'] = $precision;
        }
        if ($includeContainer) {
            return '<span class="price">' . ($addBrackets ? '[' : '') . $this->formatTxt(
                $price,
                $options
            ) . ($addBrackets ? ']' : '') . '</span> <span class="symbol">'.$this->getCode().'</span>';
        }
        return $this->formatTxt($price, $options).' '.$this->getCode();
    }

    public function formatPrecisionWithoutCode(
        $price,
        $precision,
        $options = [],
        $includeContainer = true,
        $addBrackets = false
    ) {
        if (!isset($options['precision'])) {
            $options['precision'] = $precision;
        }
        if ($includeContainer) {
            return '<span class="price">' . ($addBrackets ? '[' : '') . $this->formatTxt(
                $price,
                $options
            ) . ($addBrackets ? ']' : '') . '</span> <span class="symbol">'.$this->getCode().'</span>';
        }
        return $this->formatTxt($price, $options);
    }

    public function getOutputFormat()
    {
        $formatted = $this->formatTxt(0);
        $number = $this->formatTxt(0, ['display' => \Magento\Framework\Currency::NO_SYMBOL]);
        return str_replace($this->trimUnicodeDirectionMark($number), '%s '.$this->getCode(), $formatted);
    }
    private function trimUnicodeDirectionMark($string)
    {
        if (preg_match('/^(\x{200E}|\x{200F})/u', $string, $match)) {
            $string = preg_replace('/^'.$match[1].'/u', '', $string);
        }
        return $string;
    }
    
}
