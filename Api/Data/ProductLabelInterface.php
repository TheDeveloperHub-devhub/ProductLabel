<?php declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface ProductLabelInterface extends ExtensibleDataInterface
{
    const ID = 'id';
    const RIBBON_NAME = 'ribbon_name';
    const FONT_COLOR = 'font_color';
    const BACKGROUND_COLOR = 'background_color';
    const RIBBON_TYPE = 'ribbon_type';
    const MAIN_TABLE = 'developerhub_product_label';

    /** @return mixed */
    public function getId();

    /** @return string */
    public function getRibbonName();

    /**
     * @param $ribbonName
     * @return mixed
     */
    public function setRibbonName($ribbonName);

    /** @return mixed */
    public function getFontColor();

    /**
     * @param $ribbonType
     * @return mixed
     */
    public function setFontColor($ribbonType);

    /** @return mixed */
    public function getBackgroundColor();

    /**
     * @param $ribbonType
     * @return mixed
     */
    public function setBackgroundColor($ribbonType);

    /** @return mixed */
    public function getRibbonType();

    /**
     * @param $ribbonType
     * @return mixed
     */
    public function setRibbonType($ribbonType);
}
