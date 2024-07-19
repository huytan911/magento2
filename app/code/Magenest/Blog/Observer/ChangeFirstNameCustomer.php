<?php

namespace Magenest\Blog\Observer;

class ChangeFirstNameCustomer implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerData = $observer->getEvent()->getData('customer');
        $customerData->setFirstname('Magenest_Blog_1');

        return $this;
    }
}
