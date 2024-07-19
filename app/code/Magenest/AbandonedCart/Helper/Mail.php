<?php

namespace Magenest\AbandonedCart\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Checkout\Model\Cart;
class Mail extends \Magento\Framework\App\Helper\AbstractHelper{

    protected $logger;
    protected $escaper;
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $_customerSession;
    protected $_cart;


    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        CustomerSession $customerSession,
        Cart $cart,
    ) {
        parent::__construct($context);
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->escaper = $escaper;
        $this->logger = $context->getLogger();
        $this->_customerSession = $customerSession;
        $this->_cart = $cart;
    }

    public function sendMail() {

        $customerName = $this->_customerSession->getCustomer()->getName();
        $cartItems = $this->_cart->getQuote()->getAllItems();

        $recipient_address = 'nguyentan65431@gmail.com';
        $from_address = [
            'name' => 'Huy Tân',
            'email' => 'nguyentan65432@gmail.com'
        ];
        $storeId = 2;

        $this->_inlineTranslation->suspend();
        $this->_transportBuilder->setTemplateIdentifier(
            'abandonedcart_item1'
        )
            ->setTemplateOptions(
            [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ]
        )
        ->setTemplateVars(
           [
               'customerName' => $customerName,
           ]
        )
        ->setFrom(
            $from_address
        )
        ->addTo(
            $recipient_address, 'Admin'
        );

        $transport = $this->_transportBuilder->getTransport();
        try {
            $transport->sendMessage();
            $this->_inlineTranslation->resume();
        } catch (\Exception $exception) {
            $this->_logger->critical($exception->getMessage());
        }
    }
}
