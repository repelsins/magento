<?php

namespace Magebit\ProductComments\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magebit\ProductComments\Model\CommentsFactory;

/**
 * Class Index
 * @package Magebit\ProductComments\Controller\Index
 */
class Index extends Action
{
    /**
     * @var \Magebit\ProductComments\Model\CommentsFactory
     */
    protected $_modelCommentsFactory;

    /**
     * @param Context $context
     * @param CommentsFactory $modelCommentsFactory
     */
    public function __construct(
        Context $context,
        CommentsFactory $modelCommentsFactory
    ) {
        parent::__construct($context);
        $this->_modelCommentsFactory = $modelCommentsFactory;
    }


    public function execute()
    {

        $commentsModel = $this->_modelCommentsFactory->create();

        // Load the item with ID is 1
        $item = $commentsModel->load(1);
        var_dump($item->getData());

        // Get news collection
        $commentsCollection = $commentsModel->getCollection();
        // Load all data of collection
        var_dump($commentsCollection->getData());
    }
}