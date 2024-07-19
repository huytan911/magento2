<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Button extends Field
{

    public function render(AbstractElement $element)
    {
        $element->setValue('Reload Page');
        $element->setData('onclick', 'window.location.reload()');
        $element->setData('class', 'action-default scalable save primary ui-button ui-corner-all ui-widget');

        return parent::render($element);
    }
}
