<?php

namespace Magebit\ProductComments\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Catalog\Api\ProductRepositoryInterface;


/**
 * Class Name
 * @package Magebit\ProductComments\Ui\Component\Listing\Column
 */
class Name extends Column
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * Name constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [], ProductRepositoryInterface $productRepository)
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->productRepository = $productRepository;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $product = $this->productRepository->getById($item['product_id']);
                $item['product_name'] = $product->getName();
            }
        }

        return $dataSource;
    }
}