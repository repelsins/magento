<?php

namespace Magebit\ProductComments\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Comments
 * @package Magebit\ProductComments\Model
 */
class Comments extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Magebit\ProductComments\Model\ResourceModel\Comments');
    }

    /**
     * Validate review summary fields
     *
     * @return bool|string[]
     */
    public function validate()
    {
        $errors = [];

        if (!\Zend_Validate::is($this->getEmail(), 'EmailAddress')) {
            $errors[] = __('Invalid email address.');
        }

        if (!\Zend_Validate::is($this->getName(), 'NotEmpty')) {
            $errors[] = __('Please enter a name.');
        }

        if (!\Zend_Validate::is($this->getComment(), 'NotEmpty')) {
            $errors[] = __('Please enter the comment.');
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
    }
}