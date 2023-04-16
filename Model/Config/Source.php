<?php

declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

class Source implements OptionSourceInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'Static', 'label' => __('Static')],
            ['value' => 'Dynamic', 'label' => __('Dynamic')]
        ];
    }
}







