<?php

namespace Magebit\ProductComments\Controller\Adminhtml\Comments;

use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package Magebit\ProductComments\Controller\Adminhtml\Comments
 */
class Index extends Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }


}