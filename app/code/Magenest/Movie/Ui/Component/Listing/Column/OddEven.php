<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class OddEven extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if($item['entity_id'] % 2 == 0){
                    $item['even_odd'] = 'even';
                }
                else {
                    $item['even_odd'] = 'odd';
                }
            }
        }
        return $dataSource;
    }
}
