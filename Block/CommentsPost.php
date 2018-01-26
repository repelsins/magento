<?php

namespace Magebit\ProductComments\Block;

use Magento\Framework\View\Element\Template;
use Magebit\ProductComments\Model\CommentsFactory;

class CommentsPost extends Template
{
    /**
     * @var \Magebit\ProductComments\Model\CommentsFactory
     */
    protected $_commentsFactory;
    protected $_registry;

    protected $_template = 'Magebit_ProductComments::form.phtml';

    /**
     * @param Template\Context $context
     * @param CommentsFactory $commentsFactory
     * @param array $data
     * @param \Magento\Framework\Registry $registry,
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\Registry $registry,
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