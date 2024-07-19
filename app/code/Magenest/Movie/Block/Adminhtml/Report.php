<?php
namespace Magenest\Movie\Block\Adminhtml;
class Report extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;
    protected $_productFactory;

    protected $_orderFactory;
    protected $_invoiceFactory;
    protected $_creditmemoFactory;
    protected $fullModuleList;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditmemoFactory,
        \Magento\Framework\Module\FullModuleList $fullModuleList,
    )
    {
        $this->_customerFactory = $customerFactory;
        $this->_productFactory = $productFactory;
        $this->_orderFactory = $orderFactory;
        $this->_invoiceFactory = $invoiceFactory;
        $this->_creditmemoFactory = $creditmemoFactory;
        $this->fullModuleList = $fullModuleList;
        parent::__construct($context);
    }

    public function getExternalModuleCount()
    {
        $moduleList = $this->fullModuleList->getNames();
        $customModuleCount = 0;

        foreach ($moduleList as $moduleName) {
            if (!str_contains($moduleName, 'Magento_') && !str_contains($moduleName, 'PayPal_')) {
                $customModuleCount++;
            }
        }

        return $customModuleCount;
    }
    public function getNumberOfCustomer(){
        return $this->_customerFactory->create()->getCollection()->getSize();
    }
    public function getNumberOfProduct(){
        return $this->_productFactory->create()->getCollection()->getSize();
    }
    public function getNumberOfOrder(){
        return $this->_orderFactory->create()->getCollection()->getSize();
    }
    public function getNumberOfInvoice(){
        return $this->_invoiceFactory->create()->getSize();
    }
    public function getNumberOfCreditmemo(){
        return $this->_creditmemoFactory->create()->getSize();
    }
}
