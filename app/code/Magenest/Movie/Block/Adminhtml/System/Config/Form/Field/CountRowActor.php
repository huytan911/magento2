<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magenest\Movie\Model\ActorFactory;
class CountRowActor extends Field
{

    protected $_actorFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        ActorFactory $actorFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_actorFactory = $actorFactory;
    }


    public function render(AbstractElement $element)
    {
        $num = $this->_actorFactory->create()->getCollection()->getSize();
        $element->setValue($num);
        $element->setReadonly(true);

        return parent::render($element);
    }
}
