<?php
/**
 * @category IMI
 * @package IMI_ForwardToConfigurable
 */

namespace IMI\HideEmptyAttributes\Helper;


use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Block\Product\Compare\ListCompare;
use Magento\Catalog\Helper\Output as CatalogOutputHelper;

/**
 * Class Data
 * @package IMI\ForwardToConfigurable\Helper
 */
class HideEmptyCompareAttribues extends AbstractHelper
{

    /**
     * @var ListCompare
     */
    protected $_listCompare;

    /**
     * @var CatalogOutputHelper
     */
    protected $_catalogOutputHelper;

    /**
     * HideEmptyCompareAttribues constructor.
     * @param Context $context
     * @param CatalogOutputHelper $catalogOutputHelper
     * @param ListCompare $listCompare
     */
    public function __construct(
        Context $context,
        CatalogOutputHelper $catalogOutputHelper,
        ListCompare $listCompare
    ) {
        parent::__construct($context);
        $this->_listCompare = $listCompare;
        $this->_catalogOutputHelper = $catalogOutputHelper;
    }




    public function getAttributeIsSet (\Magento\Eav\Model\Entity\Attribute\AbstractAttribute $_attribute, \Magento\Catalog\Model\ResourceModel\Product\Compare\Item\Collection $_items)
    {
        $attrSet = false;
        foreach ($_items as $_item){
            switch ($_attribute->getAttributeCode()) {
                case "price":
                    $attrSet = true;
                    break;
                case "small_image":
                    $attrSet = true;
                    break;
                default:
                    $var = $this->_catalogOutputHelper->productAttribute($_item, $this->_listCompare->getProductAttributeValue($_item, $_attribute), $_attribute->getAttributeCode());
                    if ($var != __('N/A') && $var != __('No')) {
                        $attrSet = true;
                    }
                    break;
            }
            if ($attrSet) {
                break;
            }
        }
        return $attrSet;
    }

}