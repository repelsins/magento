<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 18.4.1
 * Time: 14:37
 */

namespace Magebit\ProductComments\Controller\Adminhtml\Comments;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

class Edit extends Action
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}