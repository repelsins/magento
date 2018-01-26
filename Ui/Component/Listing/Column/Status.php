<?php
/**
 * Created by PhpStorm.
 * User: magebit
 * Date: 18.17.1
 * Time: 15:32
 */

namespace Magebit\ProductComments\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column implements OptionSourceInterface

{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {

                if ($item['status_id'] == '1') {
                    $item['status'] = 'Approved';
                } else {
                    $item['status'] = 'Not Approved';
                }
            }
        }
        return $dataSource;
    }

    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Approved')],
            ['value' => 0, 'label' => __('Not Approved')],
        ];
    }
}


