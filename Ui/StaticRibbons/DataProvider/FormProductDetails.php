<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Ui\StaticRibbons\DataProvider;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use DeveloperHub\ProductLabel\Utils\Price;

class FormProductDetails
{
    /** @var ProductCollectionFactory */
    private $productCollectionFactory;

    /** @var Price */
    private $priceModifier;

    /** @var Image */
    private $imageHelper;

    /**
     * @param ProductCollectionFactory $productCollectionFactory
     * @param Image $imageHelper
     * @param Price $priceModifier
     */
    public function __construct(
        ProductCollectionFactory $productCollectionFactory,
        Image $imageHelper,
        Price $priceModifier
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->imageHelper = $imageHelper;
        $this->priceModifier = $priceModifier;
    }

    /**
     * @param $Data
     * @return array
     */
    public function getProductDetails(&$Data)
    {
        $modifiedData['products']['products'] = [];

        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addFieldToFilter('entity_id', ['in' => $Data->getData('product_ids')])
            ->addAttributeToSelect(['status', 'thumbnail', 'name', 'price'], 'left');
        /** @var ProductInterface $product */
        $count = 1;
        foreach ($productCollection->getItems() as $product) {
            $data = $this->fillProductData($product);
            $data['position2'] = $count;
            $data['record_id'] = $data['entity_id'];
            $modifiedData['products']['products'][]= $data;
            $count++;
        }

        return $modifiedData['products'];
    }

    /**
     * @param ProductInterface $product
     * @return array
     * @throws \Zend_Currency_Exception
     */
    private function fillProductData(ProductInterface $product)
    {
        return [
            'entity_id' => $product->getId(),
            'thumbnail' => $this->imageHelper->init($product, 'product_listing_thumbnail')->getUrl(),
            'name' => $product->getName(),
            'status' => $product->getStatus(),
            'type_id' => $product->getTypeId(),
            'sku' => $product->getSku(),
            'price' => $product->getPrice() ? $this->priceModifier->toDefaultCurrency($product->getPrice()) : ''
        ];
    }
}
