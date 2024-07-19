<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

class NewMovie extends \Magento\Backend\App\Action
{
    protected $_resultForwardFactory = false;

    public function __construct
    (
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->_resultForwardFactory->create();
        $resultPage->forward('edit');
        return $resultPage;
    }
}
