<?php

namespace Magenest\Movie\Observer;

class ChangeRatingMovie implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $movieData = $observer->getEvent()->getMovieAbcdefgh();
        $movieData->rating = 0;

        return $this;
    }
}
