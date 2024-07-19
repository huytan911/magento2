<?php

namespace Magenest\Blog\Block\Blog;

use Magenest\Blog\Model\BlogFactory;

class View extends \Magento\Framework\View\Element\Template {

    protected $_blogFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        BlogFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getBlogObject()
    {
        $id = $this->getRequest()->getParam('id');
        return $this->_blogFactory->create()->load($id);
    }
}
