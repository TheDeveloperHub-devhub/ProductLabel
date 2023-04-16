<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use DeveloperHub\ProductLabel\Api\Data\ProductLabelInterface;

class ProductLabel extends AbstractDb
{
    /** @return void */
    protected function _construct()
    {
        $this->_init(ProductLabelInterface::MAIN_TABLE, ProductLabelInterface::ID);
    }
}
