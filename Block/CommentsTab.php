<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 17.21.12
 * Time: 16:55
 */

namespace Magebit\ProductComments\Block;


use Magento\Catalog\Block\Product\View;

class CommentsTab extends View
{
    public function _toHtml()
    {
        if (!$this->getProduct()->getData('commenting')) {
            return '';
        }

        return parent::_toHtml();
    }
}