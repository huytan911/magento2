<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magenest\Movie\Model\MovieFactory;
class CountRowMovie extends Field
{

    protected $_movieFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        MovieFactory $movieFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_movieFactory = $movieFactory;
    }


    public function render(AbstractElement $element)
    {
        $num = $this->_movieFactory->create()->getCollection()->getSize();
        $element->setValue($num);
        $element->setReadonly(true);

        return parent::render($element);
    }
}
