<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;
use DeveloperHub\ProductLabel\Model\ProductLabelModel;

class CatalogPriceRuleLabelSource implements OptionSourceInterface
{
    /** @var ProductLabelModel  */
    private $productLabelModel;

    /** @param ProductLabelModel $productLabelModel */
    public function __construct(ProductLabelModel $productLabelModel)
    {
        $this->productLabelModel = $productLabelModel;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        $labelCollection = $this->productLabelModel->getCollection()
            ->addFieldToFilter('ribbon_type', ['eq'=>'Dynamic']);

        foreach ($labelCollection as $label) {
            $options[] = [
                'label' => $label->getRibbonName(),
                'value' => $label->getID(),
            ];
        }

        return $options;
    }
}
