<?php
namespace Magenest\Movie\Model\ResourceModel\Movie;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'movie_id';
    protected $_eventPrefix = 'magenest_movie_collection';
    protected $_eventObject = 'movie_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Movie\Model\Movie', 'Magenest\Movie\Model\ResourceModel\Movie');
    }
    public function getMovieData() {
        $result = $this
            ->addFieldToSelect('name','movie')
            ->addFieldToSelect('description')
            ->addFieldToSelect('rating')
            ->join(
                ['md' => $this->getTable('magenest_director')],
                'main_table.director_id = md.director_id',
                ['director' => 'name']
            )
            ->join(
                ['mma' => $this->getTable('magenest_movie_actor')],
                'main_table.movie_id = mma.movie_id',
                []
            )
            ->join(
                ['ma' => $this->getTable('magenest_actor')],
                'mma.actor_id = ma.actor_id',
                ['actor' => 'name']
            )->getSelect();
        return $this;
    }
}

