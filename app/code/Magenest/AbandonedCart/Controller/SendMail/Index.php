<?php

namespace Magenest\AbandonedCart\Controller\SendMail;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action {

    protected $_pageFactory;
    protected $_sendMailHelper;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magenest\AbandonedCart\Helper\Mail $helper
    )
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_sendMailHelper = $helper;
    }

    public function execute()
    {
        $this->_sendMailHelper->sendMail();
        return $this->_pageFactory->create();
    }
}
