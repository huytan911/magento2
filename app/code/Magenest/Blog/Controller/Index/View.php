<?php
namespace Magenest\Blog\Controller\Index;

use Magento\Framework\App\Action\Context;

class View extends \Magento\Framework\App\Action\Action {

    protected $resultPageFactory;

    protected $example;

    protected $customer;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Blog\Api\BlogRepositoryInterface $blogRepository,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Session $customerSession,
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->example = $blogRepository;
        $this->customer = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        echo '<pre>';
        print_r($this->customer->getCustomer());
        echo '</pre>';
        return $this->resultPageFactory->create();
    }
}
