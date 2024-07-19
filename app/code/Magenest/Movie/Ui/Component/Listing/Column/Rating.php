<?php
namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Rating extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach($dataSource['data']['items'] as &$item){
                if(isset($item['rating'])){
                    $data = [];
                    for($i = 0; $i < 5; $i++)
                        if($i < ($item['rating'] / 2)) {
                            if ($item['rating'] / 2 - $i == 0.5) {
                                $data[] = 'half';
                            }
                            else {
                                $data[] = 'selected';
                            }
                        }
                        else
                            $data[] = 'notSelected';
                    $item['rating'] = $data;
                }
            }
        }
        return $dataSource;
    }
}
