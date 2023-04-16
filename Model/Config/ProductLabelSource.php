<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use DeveloperHub\ProductLabel\Model\ProductLabelModel;

class ProductLabelSource extends AbstractSource
{
    /** @var ProductLabelModel  */
    private $productLabelModel;

    /** @param ProductLabelModel $productLabelModel */
    public function __construct(
        ProductLabelModel $productLabelModel
    ) {
        $this->productLabelModel = $productLabelModel;
    }

    /**
     * @return array
     */
    public function getAllOptions()
    {
        $options[] = ['label' => '', 'value' => ''];
        $labelCollection = $this->productLabelModel->getCollection()
            ->addFieldToFilter('ribbon_type', ['eq'=>'Static']);

        foreach ($labelCollection as $label) {
            $options[] = [
                'label' => $label->getRibbonName(),
                'value' => $label->getID(),
            ];
        }

        return $options;
    }
}
