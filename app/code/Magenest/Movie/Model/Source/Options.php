<?php
namespace Magenest\Movie\Model\Source;
use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\DirectorFactory;
class Options implements OptionSourceInterface
{
    protected $_directorFactory;
    public function __construct(
        DirectorFactory $directorFactory,
    )
    {
        $this->_directorFactory = $directorFactory;
    }
    public function toOptionArray(){
        $directors = $this->_directorFactory->create()->getCollection();
        $dataArray = [];
        foreach($directors as $director){
            $dataArray[] = ['label' => $director->getName(), 'value' => $director->getId()];
        }
        return $dataArray;
    }
}
