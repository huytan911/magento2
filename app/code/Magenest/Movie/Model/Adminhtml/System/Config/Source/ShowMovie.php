<?php

namespace Magenest\Movie\Model\Adminhtml\System\Config\Source;
class ShowMovie implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray() : array
    {
        $options = [
            1 => 'Show',
            2 => 'Not Show'
        ];
        return $options;
    }
}
