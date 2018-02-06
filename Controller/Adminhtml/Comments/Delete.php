<?php

namespace Magebit\ProductComments\Controller\Adminhtml\Comments;

use Magento\Backend\App\Action;
use Magebit\ProductComments\Model\Comments;

/**
 * Class Delete
 * @package Magebit\ProductComments\Controller\Adminhtml\Comments
 */
class Delete extends Action
{
    /**
     * @var Comments
     */
    protected $_model;

    /**
     * @param Action\Context $context
     * @param \Magebit\ProductComments\Model\Comments $model
     */
    public function __construct(
        Action\Context $context,
        Comments $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }


    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Comment deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['comment_id' => $id]);
            }
        }
        $this->messageManager->addError(__('Comment does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}