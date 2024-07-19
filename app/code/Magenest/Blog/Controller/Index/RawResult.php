<?php

namespace Magenest\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class RawResult extends Action
{
    protected $resultRawFactory;
    /**
     * Set the Context and Result Page Factory from DI.
     * @param Context     $context
     * @param RawFactory $rawResultFactory
     */
    public function __construct(
        Context $context,
        RawFactory $rawResultFactory
    ) {
        $this->resultRawFactory = $rawResultFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types Raw Result.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute() {
        $result = $this->resultRawFactory->create();
        $result->setHeader('Content-Type', 'text/xml');
        $result->setContents("<note>
	                                <to>Tove</to>
	                                <from>Jani</from>
	                                <heading>Reminder</heading>
	                                <body>Don't forget me this weekend!</body>
	                            </note>");
        return $result;
    }
}
