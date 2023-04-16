<?php declare(strict_types=1);

namespace DeveloperHub\ProductLabel\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use DeveloperHub\ProductLabel\Model\Config\ProductLabelSource;

class AddProductAttribute implements DataPatchInterface
{
    /** @var ModuleDataSetupInterface  */
    private ModuleDataSetupInterface $moduleDataSetup;

    /** @var EavSetupFactory  */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /** @return array|string[] */
    public static function getDependencies()
    {
        return [];
    }

    /** @return array|string[] */
    public function getAliases()
    {
        return [];
    }

    /** @return AddProductAttribute|void */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            'ribbon_ids',
            [
                'label' => 'Ribbons Name',
                'type'  => 'varchar',
                'input' => 'multiselect',
                'source' => ProductLabelSource::class,
                'required' => false,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'backend' => ArrayBackend::class,
            ]
        );
    }
}
