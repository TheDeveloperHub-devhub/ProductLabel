<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Ui\StaticRibbons\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /** @var CollectionFactory */
    protected $collection;

    /** @var FormProductDetails */
    private $formProductDetails;

    /** @var array */
    private $loadedData;

    /**
     * @param CollectionFactory $collectionFactory
     * @param FormProductDetails $formProductDetails
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        CollectionFactory  $collectionFactory,
        FormProductDetails $formProductDetails,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->formProductDetails = $formProductDetails;
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $item['ribbon_ids'] = explode(',', $item->getData('ribbon_ids'));
            $item['category_ids'] = explode(',', $item->getData('category_ids') ?? "");
            $productIds = explode(',', $item->getData('product_ids') ?? "");
            $this->loadedData[$item->getData('id')] = $item->getData();
            $providerProductIds = [];
            foreach ($productIds as $id) {
                $providerProductIds[] = [
                    'entity_id' => $id
                ];
            }
            $this->loadedData[$item->getData('id')]['product_ids'] = $providerProductIds;
            $this->loadedData[$item->getData('id')]['products'] = $this->formProductDetails->getProductDetails($item);
        }

        return $this->loadedData;
    }
}
