<?php

namespace Magenest\Movie\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class UpgradeData implements UpgradeDataInterface {
    private $eavSetupFactory;
    /**
     * @var Config
     */
    private $eavConfig;
    /**
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory,
        AttributeSetFactory $attributeSetFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig            = $eavConfig;
        $this->attributeSetFactory  = $attributeSetFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.0.2','>')) {
            $this->addUnitNumberFieldToAddress($setup);
        }
//        if (version_compare($context->getVersion(), '0.0.3','<')) {
//            $this->updateUnitAttribute($setup);
//        }
        $setup->endSetup();
    }

    /**
     * put your comment there...
     *
     * @param mixed $setup
     */
    protected function addUnitNumberFieldToAddress($setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute('customer_address', 'vn_region', [
            'type' => 'int',
            'input' => 'select',
            'label' => 'VN Region',
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'source' => '',
            'system'=> false,
            'group'=> 'General',
            'sort_order' => 71,
            'global' => true,
            'visible_on_front' => true,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'vn_region');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address','customer_address_edit','customer_register_address']
        );
        $customAttribute->save();


        $installer = $setup;


        $installer->getConnection()->addColumn(
            $installer->getTable('quote_address'),
            'vn_region',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'comment' => 'VN Region'
            ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable('sales_order_address'),
            'vn_region',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length' => 255,
                'comment' => 'VN Region'
            ]
        );
    }
    public function updateUnitAttribute($setup)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->updateAttribute('customer_address', 'vn_region', 'sort_order', '71');
    }
}
