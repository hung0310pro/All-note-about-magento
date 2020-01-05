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
namespace Stussy\ConfigurableProduct\Model;

/**
 * Class ConfigurableAttributeData
 *
 * @package Stussy\ConfigurableProduct\Model
 */
class ConfigurableAttributeData extends \Magento\ConfigurableProduct\Model\ConfigurableAttributeData
{
    /**
     * @param Attribute $attribute
     * @param array $config
     * @return array
     */
    protected function getAttributeOptionsData($attribute, $config)
    {
        $productAttribute = $attribute->getProductAttribute();
        $attributeId = $productAttribute->getId();
        $attributeOptionsData = [];
        $optionIds = [];
        if($config && $attributeId){
            foreach($config[$attributeId] as $optionId => $productId){
                $key = array_search($optionId, array_column($attribute->getOptions(), 'value_index'));
                if($key > -1 || $key = 0){
                    $attributeOptionsData[] = [
                        'id' => $optionId,
                        'label' => $attribute->getOptions()[$key]['label'],
                        'products' => isset($config[$attribute->getAttributeId()][$optionId])
                            ? $config[$attribute->getAttributeId()][$optionId]
                            : [],
                    ];
                }else{
                    $attributeOptionsData[] = [
                        'id' => $optionId,
                        'label' => '',
                        'products' => [],
                    ];
                }
            }
        }
        return $attributeOptionsData;
    }
}