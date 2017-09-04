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

namespace IMI\HideEmptyAttributes\Plugin\Eav\Model\Entity\Attribute\Frontend;

class AbstractFrontend {
    /**
     * Allow empty input in everything but boolean fields
     *
     * @param \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend $subject
     * @param callable $proceed
     * @param \Magento\Framework\DataObject $object
     *
     * @return null
     */
    public function aroundGetValue(
        \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend $subject,
        callable $proceed,
        \Magento\Framework\DataObject $object
    ) {
        $value = $object->getData($subject->getAttribute()->getAttributeCode());
        if (!$value && $subject->getConfigField('input') != 'boolean') {
            return null;
        }
        return $proceed($object);
    }
}
