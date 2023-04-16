<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DeveloperHub\ProductLabel\Model\ProductLabelModel;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel as ProductLabelResourceModel;

class Collection extends AbstractCollection
{
    /** @return void */
    protected function _construct()
    {
        $this->_init(ProductLabelModel::class, ProductLabelResourceModel::class);
    }
}
