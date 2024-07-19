<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;

class Edit extends \Magento\Framework\App\Action\Action
{

    protected $_resultPageFactory;

    public function __construct (
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\App\Action\Context $context,
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Movie Information')));
        return $resultPage;
    }
}
