<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Ui\Component\Price\Listing\Columns\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use DeveloperHub\ProductLabel\Utils\Price as PriceModifier;

class Price extends Column
{
    /** @var PriceModifier */
    private $priceModifier;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param PriceModifier $priceModifier
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        PriceModifier $priceModifier,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->priceModifier = $priceModifier;
    }

    /**
     * @param array $dataSource
     * @return array
     * @throws \Zend_Currency_Exception
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['price'])) {
                    $item['price'] = $this->priceModifier->toDefaultCurrency($item['price']);
                }
            }
        }

        return $dataSource;
    }
}
