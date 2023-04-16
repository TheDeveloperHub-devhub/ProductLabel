<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\ViewModel;

use Magento\Catalog\Helper\Data;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\Collection;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\CollectionFactory;

class StaticRibbons implements ArgumentInterface
{
    /** @var ResourceConnection  */
    private $resourceConnection;

    /** @var CollectionFactory  */
    private $collectionFactory;

    /** @var Data  */
    private $catalogHelper;

    /** @var Configurable  */
    private $configurable;

    /**
     * @param ResourceConnection $resourceConnection
     * @param CollectionFactory $collectionFactory
     * @param Data $catalogHelper
     * @param Configurable $configurable
     */
    public function __construct(
        ResourceConnection  $resourceConnection,
        CollectionFactory   $collectionFactory,
        Data $catalogHelper,
        Configurable $configurable
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->collectionFactory = $collectionFactory;
        $this->catalogHelper = $catalogHelper;
        $this->configurable = $configurable;
    }

    /** @return Product|null */
    public function getLoadedProduct()
    {
        return $this->catalogHelper->getProduct();
    }

    /**
     * @param $parentId
     * @return array
     */
    public function getChildIds($parentId)
    {
        return $this->configurable->getChildrenIds($parentId);
    }

    /**
     * @param $productIds
     * @param $categoryId
     * @return Collection|void|null
     */
    public function getRibbonsData($productIds, $categoryId = null)
    {
        if ($categoryId != null) {
            return $this->getRibbonsDataforCategoryIds($categoryId);
        }
        return $this->getRibbons($productIds);
    }
    /**
     * @param $productIds
     * @return Collection|void
     */
    public function getRibbons($productIds)
    {
        $connection = $this->resourceConnection->getConnection();
        $ribbonIds = $connection
            ->select()->from(
                $this->resourceConnection
                    ->getTableName('developerhub_static_ribbons_attachments'),
                'ribbon_ids'
            )
        ->where("FIND_IN_SET(?, product_ids)", $productIds);
        $ribbonIdsResult = $connection->fetchAll($ribbonIds);
        $ribbonIdsResult = implode(',', $ribbonIdsResult[0] ?? []);
        $collection = $this->collectionFactory->create();
        if (!empty($ribbonIdsResult)) {
            $ribbonsData = $collection->addFieldToFilter('id', ['in' => $ribbonIdsResult]);
            return $ribbonsData;
        }
    }

    /**
     * @param string $categoryId
     * @return Collection|null
     */
    public function getRibbonsDataforCategoryIds(string $categoryId)
    {
        $connection = $this->resourceConnection->getConnection();
        $ribbonIds = $connection
            ->select()->from(
                $this->resourceConnection
                    ->getTableName('developerhub_static_ribbons_attachments'),
                ['ribbon_ids','category_ids']
            )->where("FIND_IN_SET(?, category_ids)", $categoryId);
        $ribbonIdsResult = $connection->fetchAll($ribbonIds);
        if ((int)$ribbonIdsResult !== 0) {
            $ribbonIdsResult = (array)$ribbonIdsResult[0]['ribbon_ids'] ?? [];
            $ribbonIdsResult = implode(',', $ribbonIdsResult ?? []);
            $collection = $this->collectionFactory->create();
            return $collection->addFieldToFilter('id', ['in' => $ribbonIdsResult]);
        }
        return null;
    }

}
