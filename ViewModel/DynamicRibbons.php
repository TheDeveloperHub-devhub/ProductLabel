<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\ViewModel;

use Magento\Catalog\Helper\Data;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\Collection;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel\CollectionFactory;

class DynamicRibbons implements ArgumentInterface
{
    /** @var CollectionFactory  */
    private $collectionFactory;

    /** @var ResourceConnection  */
    private $resourceConnection;

    /** @var Configurable  */
    private $configurable;

    /** @var Data  */
    private $catalogHelper;

    /**
     * @param CollectionFactory $collectionFactory
     * @param ResourceConnection $resourceConnection
     * @param Configurable $configurable
     * @param Data $catalogHelper
     */
    public function __construct(
        CollectionFactory  $collectionFactory,
        ResourceConnection $resourceConnection,
        Configurable $configurable,
        Data $catalogHelper
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->resourceConnection = $resourceConnection;
        $this->configurable = $configurable;
        $this->catalogHelper = $catalogHelper;
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
     * @param $productId
     * @return Collection|null
     */
    public function getDynamicRibbonsData($productId)
    {
        $connection = $this->resourceConnection->getConnection();
        $select = $connection
            ->select()
            ->distinct()
            ->from('catalogrule', 'id')
            ->join(
                ['catalogrule_product' => 'catalogrule_product'],
                'catalogrule_product.rule_id = catalogrule.rule_id',
                []
            )
            ->where('catalogrule_product.product_id IN(?)', $productId)
            ->where('catalogrule.is_active = 1')
            ->where('catalogrule.from_date <= ?', date("Y-m-d"))
            ->where(new \Zend_Db_Expr("(catalogrule.to_date >= " . date("Y-m-d") . " OR catalogrule.to_date is NULL)"));

        $ribbonIdsResult = $connection->fetchAll($select);
        $ribbonIdsResult = implode(',', array_column($ribbonIdsResult, ('id') ?? []));
        $collection = $this->collectionFactory->create();
        if (!empty($ribbonIdsResult)) {
            return $collection->addFieldToFilter('id', ['in' => $ribbonIdsResult]);
        }
        return null;
    }
}
