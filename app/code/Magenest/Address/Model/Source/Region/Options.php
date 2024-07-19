<?php
namespace Magenest\Address\Model\Source\Region;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options extends AbstractSource
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('-- Please Select --'), 'value' => ''],
            ['label'=>__('Miền Bắc'), 'value'=> 1],
            ['label'=>__('Miền Trung'), 'value'=> 2],
            ['label'=>__('Miền Nam'), 'value'=> 3]
        ];

        return $this->_options;
    }
}
