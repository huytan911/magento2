<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class ConfigSave implements ObserverInterface
{
    private $request;
    private $_configWriter;

    public function __construct(RequestInterface $request, WriterInterface $configWriter)
    {
        $this->request = $request;
        $this->_configWriter = $configWriter;
    }
    public function execute(Observer $observer)
    {
        $meetParams = $this->request->getParam('groups');
        $textField = $meetParams['general']['fields']['text_field'];

        if($textField['value'] == 'Ping') {
            $this->_configWriter->save('movie/general/text_field', 'Pong');
        }

        return $this;
    }
}
