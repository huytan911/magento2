<?php
namespace Magenest\Blog\Controller\Adminhtml\Blog;

class Edit extends \Magento\Backend\App\Action
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
        $resultPage->getConfig()->getTitle()->prepend((__('Blog Information')));
        return $resultPage;
    }
}
