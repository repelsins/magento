<?php

namespace Magebit\ProductComments\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Comments
 * @package Magebit\ProductComments\Model\ResourceModel
 */
class Comments extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('product_comments', 'comment_id');
    }
}