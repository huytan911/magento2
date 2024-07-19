<?php

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magento\Framework\Controller\ResultFactory;

class NewAction extends \Magento\Backend\App\Action
{
    public function __construct
    (
        \Magento\Backend\App\Action\Context $context
    )
    {
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $resultPage->forward('edit');
        return $resultPage;
    }
}

