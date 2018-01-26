<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 18.4.1
 * Time: 12:31
 */

namespace Magebit\ProductComments\Controller\Adminhtml\Comments;

use Magento\Backend\App\Action;
use Magebit\ProductComments\Model\Comments as Comments;

class NewAction extends Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $commentData = $this->getRequest()->getParam('comments');
        if(is_array($commentData)) {
            $comment = $this->_objectManager->create(Comments::class);
            $comment->setData($commentData)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/edit');
        }
    }
}