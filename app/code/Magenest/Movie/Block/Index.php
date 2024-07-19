<?php
namespace Magenest\Movie\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    protected $_customerUrl;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Url $customerUrl,
        $data = []
    )
    {
        $this->_customerUrl = $customerUrl;
        parent::__construct($context, $data);
    }
    public function getLoginPostUrl() {
        return $this->_customerUrl->getLoginPostUrl();
    }
}
