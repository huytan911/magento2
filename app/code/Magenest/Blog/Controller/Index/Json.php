<?php

namespace Magenest\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Json extends Action
{
    protected $jsonResultFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types JSON Result.
     *
     * @return \Magento\Framework\Controller\Result\Json
     */

    public function execute()
    {
        $result = $this->jsonResultFactory->create();
        $data = [
            'foo'  => 'bar',
            'success' => true
        ];
        $result->setData($data);
        return $result;
    }

}
