<?php

namespace Magenest\Blog\Block\Blog;

use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class Index extends \Magento\Framework\View\Element\Template {

    protected $blogCollectionFactory;

    protected $productFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Api\Data\ProductInterface $productFactory,
        CollectionFactory $blogCollectionFactory,
        array $data = []
    )
    {
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
//        $product = $this->productFactory->create()->load(8);
//
//        return $product->getAttributes();
    }
    protected function _prepareLayout() {
        parent::_prepareLayout();
        print_r($this->getTemplate());
        $type = $this->_request->getParam('type');
        if ($type == 'new') {
            $this->setTemplate('Magenest_Blog::test2.phtml');
        }
        print_r($this->getTemplate());
        return $this;
    }
    protected function _toHtml()
    {
        print_r($this->getTemplate());
        $type = $this->_request->getParam('type');
        if ($type == 'new') {
            $this->setTemplate('Magenest_Blog::test.phtml');
        }
        print_r($this->getTemplate());
        return parent::_toHtml();
    }

    public function getBlogData() {
        return $this->blogCollectionFactory->create()->getAuthorBlog()->getData();
    }
}
