<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 17.22.12
 * Time: 13:08
 */

namespace Magebit\ProductComments\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;


/**
 * Class Index
 * @package Magebit\ProductComments\Controller\Post
 */
class Index extends Action
{
    protected $datetime;

    public function __construct(
        Context $context,
        DateTime $datetime
    )
    {
        $this->datetime = $datetime;
        parent::__construct($context);
    }
    public function execute()
    {
        $timestamp= $this->datetime->gmtDate();
        $this->getRequest()->setPostValue('created_at', $timestamp);
        $data = $this->getRequest()->getPostValue();
        $comment = $this->_objectManager->create("Magebit\ProductComments\Model\Comments");
        $comment->setData($data);

        $validate = $comment->validate();
        if ($validate === true) {
            $comment->setStatusId('0')
                    ->save();
            $this->messageManager->addSuccess(__('You submitted your comment for moderation.'));
        } else {
            if (is_array($validate)) {
                foreach ($validate as $errorMessage) {
                    $this->messageManager->addError($errorMessage);
                }
            } else {
                $this->messageManager->addError(__('We can\'t post your review right now.'));
            }
            }
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($this->_redirect->getRefererUrl());
        return $redirect;
    }
}