<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\Config;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Products implements OptionSourceInterface
{
    /** @var CollectionFactory  */
    private $productCollectionFactory;

    /** @param CollectionFactory $productCollectionFactory */
    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->productCollectionFactory->create();
        $options = [];
        foreach ($collection as $product) {
            $options[] = ['label' => $product->getSku(), 'value' => $product->getId()];
        }

        return $options;
    }
}
