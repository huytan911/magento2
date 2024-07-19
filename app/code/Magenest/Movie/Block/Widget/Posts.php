<?php
namespace Magenest\Movie\Block\Widget;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Customer\Model\Session as CustomerSession;

class Posts extends Template implements BlockInterface {

    protected $customerSession;
    protected $_template = "widget/posts.phtml";

    public function __construct(
        CustomerSession $customerSession,
        Context $context,
    )
    {
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function checkCustomerGroup(): bool
    {
        $customerGroupId = $this->customerSession->getCustomer()->getGroupId();
        $customerGroup = $this->getCustomerGroupSelected();
        return in_array($customerGroupId, $customerGroup);
    }
    public function getCustomerGroupSelected(): array
    {
        $customerGroup = $this->getData('customer_group');
        if($customerGroup != null) {
            return  explode(",", $customerGroup);
        }
        return [];
    }
}
