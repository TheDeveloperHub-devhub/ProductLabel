<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface StaticRibbonsAttachmentInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const ATTACHMENT_TYPE = "attachment_type";
    const RIBBON_IDS = "ribbon_ids";
    const PRODUCT_IDS = "product_ids";
    const CATEGORY_IDS = "category_ids";
    const MAIN_TABLE="developerhub_static_ribbons_attachments";

    /** @return mixed */
    public function getId();

    /** @return mixed */
    public function getAttachmentType();

    /**
     * @param $attachmentType
     * @return mixed
     */
    public function setAttachmentType($attachmentType);

    /** @return mixed */
    public function getRibbonIds();

    /**
     * @param $ribbonIds
     * @return mixed
     */
    public function setRibbonIds($ribbonIds);

    /** @return mixed */
    public function getProductIds();

    /**
     * @param $productIds
     * @return mixed
     */
    public function setProductIds($productIds);

    /** @return mixed */
    public function getCategoryIds();

    /**
     * @param $categoryIds
     * @return mixed
     */
    public function setCategoryIds($categoryIds);
}
