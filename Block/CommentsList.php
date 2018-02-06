<?php

namespace Magebit\ProductComments\Block;

use Magento\Framework\View\Element\Template;
use Magebit\ProductComments\Model\CommentsFactory;
use Magento\Framework\Registry;

/**
 * Class CommentsList
 * @package Magebit\ProductComments\Block
 */
class CommentsList extends Template
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
    protected $_template = 'Magebit_ProductComments::list.phtml';

    /**
     * @param Template\Context $context
     * @param CommentsFactory $commentsFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        CommentsFactory $commentsFactory,
        array $data = []
    ) {
        $this->_commentsFactory = $commentsFactory;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Set comments collection
     */
    protected  function _construct()
    {
        parent::_construct();
        $collection = $this->_commentsFactory->create()->getCollection()
            ->setOrder('comment_id', 'DESC');
        $this->setCollection($collection);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        /** @var \Magento\Theme\Block\Html\Pager */
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'productcomments.comments.list.pager'
        );
        $pager->setLimit(5)
            ->setShowAmounts(false)
            ->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();

        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}