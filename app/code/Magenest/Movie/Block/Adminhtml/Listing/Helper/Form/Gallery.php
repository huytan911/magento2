<?php
namespace Magenest\Movie\Block\Adminhtml\Listing\Helper\Form;

class Gallery extends \Magento\Framework\View\Element\AbstractBlock {

    protected $_customerFactory;

    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Magento\Framework\Data\Form $form,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        $data = []
    ) {
        $this->form = $form;
        $this->_customerFactory = $customerFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getElementHtml()
    {
        return $this->getContentHtml();
    }
}
