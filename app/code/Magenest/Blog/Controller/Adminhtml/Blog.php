<?php

namespace Magenest\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magenest\Blog\Model\BlogFactory;

abstract class Blog extends Action {
    const ADMIN_RESOURCE = 'Magenest_Blog::blog';

    public $blogFactory;

    public $coreRegistry;

    public function __construct(
        BlogFactory $blogFactory,
        Registry $coreRegistry,
        Context $context
    ) {
        $this->blogFactory = $blogFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    public function initBlog($register = false, $isSave = false) {
        $blogId = (int)$this->getRequest()->getParam('id');
        $url_rewrite = $this->getRequest()->getParam('url_rewrite');
        $blog = $this->blogFactory->create();
        if($blogId) {
            if(!$isSave) {
                $blog->load($blogId);
                if(!$blog->getId()) {
                    $this->messageManager->addErrorMessage(__('This blog no longer exists.'));

                    return false;
                }
            }
        }
        if (!$blog->getAuthorId()) {
            $blog->setAuthorId($this->_auth->getUser()->getId());
        }

        if ($register) {
            $this->coreRegistry->register('magenest_blog_blog', $blog);
        }
        return $blog;
    }
}
