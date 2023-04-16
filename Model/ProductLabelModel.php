<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model;

use Magento\Framework\Model\AbstractModel;
use DeveloperHub\ProductLabel\Api\Data\ProductLabelInterface;
use DeveloperHub\ProductLabel\Model\ResourceModel\ProductLabel as ProductLabelResourceModel;

class ProductLabelModel extends AbstractModel implements ProductLabelInterface
{
    /** @return void */
    public function _construct()
    {
        $this->_init(ProductLabelResourceModel::class);
    }

    /** @return mixed|null */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /** @return string */
    public function getRibbonName()
    {
        return $this->_getData(self::RIBBON_NAME);
    }

    /**
     * @param $ribbonName
     * @return mixed|void
     */
    public function setRibbonName($ribbonName)
    {
        $this->setData(self::RIBBON_NAME, $ribbonName);
    }

    /** @return mixed|null */
    public function getFontColor()
    {
        return $this->_getData(self::FONT_COLOR);
    }

    /**
     * @param $fontColor
     * @return mixed|void
     */
    public function setFontColor($fontColor)
    {
        $this->setData(self::FONT_COLOR, $fontColor);
    }

    /** @return mixed|null */
    public function getBackgroundColor()
    {
        return $this->_getData(self::BACKGROUND_COLOR);
    }

    /**
     * @param $backgroundColor
     * @return mixed|void
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->setData(self::BACKGROUND_COLOR, $backgroundColor);
    }

    /** @return mixed|null */
    public function getRibbonType()
    {
        return $this->_getData(self::RIBBON_TYPE);
    }

    /**
     * @param $ribbonType
     * @return mixed|void
     */
    public function setRibbonType($ribbonType)
    {
        $this->setData(self::RIBBON_TYPE, $ribbonType);
    }
}
