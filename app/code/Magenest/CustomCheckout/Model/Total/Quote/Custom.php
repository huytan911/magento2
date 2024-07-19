<?php
namespace Magenest\CustomCheckout\Model\Total\Quote;
/**
 * Class Custom
 * @package Meetanshi\HelloWorld\Model\Total\Quote
 */
class Custom extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $_priceCurrency;

    protected $storeManager;

    /**
     * Custom constructor.
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
    )
    {
        $this->_priceCurrency = $priceCurrency;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this|bool
     */
    public function collect(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        parent::collect($quote, $shippingAssignment, $total);

        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }

        $baseDiscount = 200000;
        $discount = $this->_priceCurrency->convert($baseDiscount);
        $total->addTotalAmount('custom_discount', -$discount);
        $total->addBaseTotalAmount('custom_discount', -$baseDiscount);
        $quote->setCustomDiscount(-$discount);
        return $this;
    }

    public function fetch(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $baseDiscount = 200000;
        $discount = $this->_priceCurrency->convert($baseDiscount);
        return [
            'code' => 'custom_discount',
            'title' => __('Custom Discount'),
            'value' => $discount,
        ];
    }
}
