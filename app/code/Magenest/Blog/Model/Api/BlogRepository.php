<?php

namespace Magenest\Blog\Model\Api;

use Exception;
use Magenest\Blog\Model\BlogFactory;
use Magenest\Blog\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magenest\Blog\Helper\Data as HelperData;

class BlogRepository implements BlogRepositoryInterface {

    protected $_blogFactory;

    protected $helperData;

    public function __construct(
        BlogFactory $blogFactory,
        HelperData $helper,
    ) {
        $this->_blogFactory = $blogFactory;
        $this->helperData = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllBlog()
    {
        $collection = $this->_blogFactory->create()->getCollection();

        return $collection->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlogById($id) {
        $blog = $this->_blogFactory->create()->load($id);

        return $blog;
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function deleteBlog($id) {
        $blog = $this->_blogFactory->create()->load($id);

        if($blog->getId()) {
            $this->helperData->deleteUrlRewrite($blog->getUrlRewrite());
            $blog->delete();
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function createBlog($blog) {

        $data = $blog->getData();
        $blog->addData($data);
        if(!$this->helperData->checkDuplicateUrlRewrite($blog->getUrlRewrite())) {
            $blog->save();
            $this->helperData->createUrlRewriteForBlog($blog);
            return $blog;
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function updateBlog($id, $blog) {
        if (empty($id)) {
            throw new InputException(__('Invalid Blog id %1', $id));
        }

        $subBlog = $this->_blogFactory->create()->load($id);

        if (!$subBlog->getId()) {
            throw new NoSuchEntityException(
                __(
                    'The "%1" Blog doesn\'t exist.',
                    $id
                )
            );
        }

        $subBlog->addData($blog->getData())->save();

        return $subBlog;
    }
}
