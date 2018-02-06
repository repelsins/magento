<?php

namespace Magebit\ProductComments\Block;

use Magento\Framework\View\Element\Template;
use Magebit\ProductComments\Model\CommentsFactory;
use Magento\Framework\Registry;

/**
 * Class CommentsPost
 * @package Magebit\ProductComments\Block
 */
class CommentsPost extends Template
{
    /**
     * @var \Magebit\ProductComments\Model\CommentsFactory
     */
    protected $_commentsFactory;
    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var string
     */
    protected $_template = 'Magebit_ProductComments::form.phtml';

    /**
     * @param Template\Context $context
     * @param CommentsFactory $commentsFactory
     * @param array $data
     * @param Registry $registry,
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        CommentsFactory $commentsFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_commentsFactory = $commentsFactory;
        $this->_registry = $registry;
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}