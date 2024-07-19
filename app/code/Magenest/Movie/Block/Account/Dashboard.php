<?php
namespace Magenest\Movie\Block\Account;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Framework\UrlInterface;

class Dashboard extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;
    protected $_customerSession;
    protected $store;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
    ) {
        parent::__construct($context);
        $this->_customerFactory = $customerFactory;
        $this->_customerSession = $customerSession;
        $this->store = $storeManager;
    }

    public function getCustomerInformation() {
        $customerId = $this->_customerSession->getCustomer()->getEntityId();
        return $this->_customerFactory->create()->load($customerId);
    }
    public function getCustomerAvatar() {
        $customer = $this->getCustomerInformation();
        return $this->_urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]).'customer'.$customer->getAvatar();
    }
}
