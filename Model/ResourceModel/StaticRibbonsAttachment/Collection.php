<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment\StaticRibbonsAttachment as StaticRibbonsAttachementModel ;
use DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment as StaticRibbonsResourceModel;

class Collection extends AbstractCollection
{
    /** @return void */
    protected function _construct()
    {
        $this->_init(StaticRibbonsAttachementModel::class, StaticRibbonsResourceModel::class);
    }
}
