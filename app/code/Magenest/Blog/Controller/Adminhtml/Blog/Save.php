<?php

namespace Magenest\Blog\Controller\Adminhtml\Blog;

use Exception;
use RuntimeException;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magenest\Blog\Controller\Adminhtml\Blog;
use Magenest\Blog\Model\BlogFactory;
use Magenest\Blog\Helper\Data as HelperData;
class Save extends Blog
{
    /**
     * @var BlogFactory
     */
    protected $_blogFactory;


    /**
     * @var HelperData
     */
    protected $helperData;

    public function __construct(
        Context $context,
        Registry $registry,
        BlogFactory $blogFactory,
        HelperData $helper,
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->helperData = $helper;

        parent::__construct($blogFactory, $registry, $context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $back = $this->getRequest()->getParam('back');
        $blog = $this->initBlog(false, true);
        $blog->addData($data);

        if($this->helperData->checkDuplicateUrlRewrite($data['url_rewrite'])) {
            $resultRedirect->setPath('magenest_blog/*/');
            $this->messageManager->addErrorMessage(__('This URL Rewrite was existed.'));
            return $resultRedirect;
        }

        try {
            $blog->save();
            $this->helperData->createUrlRewriteForBlog($blog);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Save Error"));
            return $this->_redirect('magenest_blog/blog/edit', ['id' => $blog->getId(), '_current' => true]);
        }
        $this->messageManager->addSuccessMessage(__("Save Success"));

        if ($back) {
            return $this->_redirect('magenest_blog/blog/edit', ['id' => $blog->getId(), '_current' => true]);
        }
        return $resultRedirect;
    }

}
