<?php

namespace Magenest\Blog\Block\Blog;

use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class Index extends \Magento\Framework\View\Element\Template {

    protected $blogCollectionFactory;

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

     public function getBlogData() {
        return $this->blogCollectionFactory->create()->getAuthorBlog()->getData();
    }
}
