<?php

namespace Magebit\ProductComments\Ui\Component\Listing\Column\Filter;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Approved')],
            ['value' => 0, 'label' => __('Not Approved')],
        ];
    }
}