<?php

namespace Magenest\Movie\Observer;

class ChangeFirstNameCustomer implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerData = $observer->getEvent()->getData('customer');
        $customerData->setFirstname('Magenest_Movie');

        return $this;
    }
}
