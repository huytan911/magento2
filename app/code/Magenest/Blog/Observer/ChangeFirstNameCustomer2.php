<?php

namespace Magenest\Blog\Observer;

class ChangeFirstNameCustomer2 implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerData = $observer->getEvent()->getData('customer');
        $customerData->setFirstname('Magenest_Blog_2');

        return $this;
    }
}
