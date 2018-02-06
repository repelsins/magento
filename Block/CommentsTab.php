<?php

namespace Magebit\ProductComments\Block;

use Magento\Catalog\Block\Product\View;

/**
 * Class CommentsTab
 * @package Magebit\ProductComments\Block
 */
class CommentsTab extends View
{
    /**
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getProduct()->getData('commenting')) {
            return '';
        }

        return parent::_toHtml();
    }
}