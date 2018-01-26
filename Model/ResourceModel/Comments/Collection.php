<?php

namespace Magebit\ProductComments\Model\ResourceModel\Comments;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'comment_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Magebit\ProductComments\Model\Comments',
            'Magebit\ProductComments\Model\ResourceModel\Comments'
        );
    }
}