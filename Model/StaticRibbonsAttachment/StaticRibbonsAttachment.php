<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\StaticRibbonsAttachment;

use Magento\Framework\Model\AbstractModel;
use DeveloperHub\ProductLabel\Model\ResourceModel\StaticRibbonsAttachment as StaticRibbonsAttachmentResourceModel;
use DeveloperHub\ProductLabel\Api\Data\StaticRibbonsAttachmentInterface;

class StaticRibbonsAttachment extends AbstractModel implements StaticRibbonsAttachmentInterface
{
    /** @return void */
    public function _construct()
    {
        $this->_init(StaticRibbonsAttachmentResourceModel::class);
    }

    /** @return mixed|null */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /** @return mixed|null */
    public function getAttachmentType()
    {
        return $this->_getData(self::ATTACHMENT_TYPE);
    }

    /**
     * @param $attachmentType
     * @return mixed|void
     */
    public function setAttachmentType($attachmentType)
    {
        $this->setData(self::ATTACHMENT_TYPE, $attachmentType);
    }

    /** @return mixed|null */
    public function getRibbonIds()
    {
        return $this->_getData(self::RIBBON_IDS);
    }

    /**
     * @param $ribbonIds
     * @return mixed|void
     */
    public function setRibbonIds($ribbonIds)
    {
        $this->setData(self::RIBBON_IDS, $ribbonIds);
    }

    /** @return mixed|null */
    public function getProductIds()
    {
        return $this->_getData(self::PRODUCT_IDS);
    }

    /**
     * @param $productIds
     * @return mixed|void
     */
    public function setProductIds($productIds)
    {
        $this->setData(self::PRODUCT_IDS, $productIds);
    }

    /** @return mixed|null */
    public function getCategoryIds()
    {
        return $this->_getData(self::CATEGORY_IDS);
    }

    /**
     * @param $categoryIds
     * @return mixed|void
     */
    public function setCategoryIds($categoryIds)
    {
        $this->setData(self::CATEGORY_IDS, $categoryIds);
    }
}
