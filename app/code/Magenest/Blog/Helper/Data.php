<?php

namespace Magenest\Blog\Helper;
use Exception;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper {


    protected $_urlRewriteFactory;

    public function __construct(
        UrlRewriteFactory $urlRewriteFactory,
        Context $context,
    )
    {
        $this->_urlRewriteFactory = $urlRewriteFactory;
        parent::__construct($context);
    }

    public function createUrlRewriteForBlog($blog)
    {
        $urlRewriteModel = $this->_urlRewriteFactory->create();
        $urlRewriteModel->setStoreId(2);
        $urlRewriteModel->setTargetPath("blog/index/view/id/".$blog->getId());
        $urlRewriteModel->setRequestPath($blog->getUrlRewrite().".html");
        $urlRewriteModel->save();

        return $urlRewriteModel;
    }

    public function checkDuplicateUrlRewrite($url_rewrite): bool
    {
        $urlRewriteCollection = $this->_urlRewriteFactory->create()->getCollection();
        $urlRewriteList = $urlRewriteCollection
            ->addFieldToSelect('request_path')
            ->getData();
        foreach ($urlRewriteList as $item) {
            if($item['request_path'] == $url_rewrite.'.html') {
                return true;
            }
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function deleteUrlRewrite($urlRewrite) {
        $urlRewriteModel = $this->_urlRewriteFactory->create()->load($urlRewrite.'.html', 'request_path');
        $urlRewriteModel->delete();
        return $urlRewriteModel;
    }
}
