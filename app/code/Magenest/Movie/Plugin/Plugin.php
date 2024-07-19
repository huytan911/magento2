<?php

namespace Magenest\Movie\Plugin;

use Magento\Checkout\CustomerData\AbstractItem;
use Magento\Quote\Model\Quote\Item;

class Plugin
{
    protected $_productRepository;
    protected $store;
    public function __construct(
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_productRepository = $productRepository;
        $this->store = $storeManager;
    }

    public function afterGetItemData(AbstractItem $subject, $result, Item $item) : array
    {
        $productSku = $result['product_sku'];
        $product = $this->_productRepository->get($productSku);
        $imageUrl = $this->store->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
        $result['product_image']['src'] = $imageUrl;
        $result['product_name'] = $product->getName();
        return $result;
    }
}
