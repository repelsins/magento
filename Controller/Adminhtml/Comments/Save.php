<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 18.4.1
 * Time: 16:05
 */

namespace Magebit\ProductComments\Controller\Adminhtml\Comments;

use Magento\Backend\App\Action;
use Magebit\ProductComments\Model\Comments;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Save extends Action
{

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private   $productRepository;
    protected $_model;

    /**
     * Save constructor.
     *
     * @param \Action\Context            $context
     * @param Comments                   $model
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        Action\Context $context,
        Comments $model,
        ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->_model            = $model;
        $this->productRepository = $productRepository;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {

            $productId = $this->getRequest()->getParam('product_id'); // change to your product id real param name
            $this->productRepository->getById($productId);

            /** @var \Vendor\Module\Model\Comments $model */
            $model = $this->_model;

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'productcomments_comments_prepare_save',
                ['comments' => $model, 'request' => $this->getRequest()]
            );
            var_dump($productId);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Comment successfully saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                // In case there is no product: display error message and redirect back
                $this->messageManager->addError($e->getMessage());

                return $resultRedirect->setPath('*/*/*');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the comment'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['comment_id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}