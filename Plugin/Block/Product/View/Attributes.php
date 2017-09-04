<?php

/**
 * @category  IMI
 *
 * @author    Osiozekhai Aliu <aliu@dev-hh.de>
 * @copyright Copyright (c) IMI (https://www.imi.de)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * @comment Filter out the the filter by category model
 */

namespace IMI\HideEmptyAttributes\Plugin\Block\Product\View;

class Attributes {

    /**
     * On catalog pages, exclude empty attributes
     * @param \Magento\Catalog\Block\Product\View\Attributes $subject
     * @param array $excludeAttr
     *
     * @return array
     */
    public function beforeGetAdditionalData( \Magento\Catalog\Block\Product\View\Attributes $subject, $excludeAttr = [] ) {
        $product    = $subject->getProduct();
        $attributes = $product->getAttributes();
        foreach ( $attributes as $attribute ) {
            if ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode(), $excludeAttr)) {
                $value = $attribute->getFrontend()->getValue( $product );
                if ( ! $product->hasData( $attribute->getAttributeCode() ) || (string) $value == '' ) {
                    $excludeAttr[] = $attribute->getAttributeCode();
                }
            }
        }
        return [ $excludeAttr ];
    }
}
