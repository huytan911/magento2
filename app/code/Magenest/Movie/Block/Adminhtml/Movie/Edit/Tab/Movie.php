<?php
namespace Magenest\Movie\Block\Adminhtml\Movie\Edit\Tab;

class Movie extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $helperData;
    protected $_movieFactory;
    protected $_coreRegistry;
    protected $_directorFactory;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magenest\Movie\Model\MovieFactory $movieFactory,
        \Magenest\Movie\Model\DirectorFactory $directorFactory,
        array $data = []
    )
    {
        $this->_movieFactory = $movieFactory;
        $this->_directorFactory = $directorFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $id = $this->getRequest()->getParam('id');

        $director = $this->_directorFactory->create();
        $directorCollection = $director->getCollection();
        $dataArray = [];
        foreach($directorCollection as $director){
            $dataArray[$director->getId()] = $director->getName();
        }

        $movie = $this->_movieFactory->create();
        $movie->load($id);

        $directorId = $movie->getDirectorId();

        $fieldset = $form->addFieldset('base_fieldset',
            ['legend' => __('Movie Information')]
        );

        if($movie->getId()) {
            $fieldset->addField('id', 'hidden',
                [
                    'name'     => 'id',
                    'value'    => $movie->getId(),
                ]);
            $fieldset->addField('name', 'text',
                [
                    'name'     => 'name',
                    'label'    => __('Name'),
                    'title'    => __('Name'),
                    'value'    =>  $movie->getName(),
                    'required' => true,
                ]);
            $fieldset->addField('rating', 'text',
                [
                    'name'     => 'rating',
                    'label'    => __('Rating'),
                    'title'    => __('Rating'),
                    'value'    =>  $movie->getRating(),
                    'required' => true,
                    'class' => 'number not-negative-amount'
                ]);
            $fieldset->addField('description', 'text',
                [
                    'name'     => 'description',
                    'label'    => __('Description'),
                    'title'    => __('Description'),
                    'value'    =>  $movie->getDescription(),
                    'required' => true,
                ]);
            $fieldset->addField('director_id', 'select',
                [
                    'name'     => 'director_id',
                    'label'    => __('Director'),
                    'title'    => __('Director'),
                    'options'  => $dataArray,
                    'value'    =>  $directorId,
                    'required' => true,
                ]);
        }
        else {
            $fieldset->addField('name', 'text',
                [
                    'name'     => 'name',
                    'label'    => __('Movie Name'),
                    'title'    => __('Movie Name'),
                    'required' => true,
                ]);
            $fieldset->addField('description', 'text',
                [
                    'name'     => 'description',
                    'label'    => __('Movie Description'),
                    'title'    => __('Movie Description'),
                    'required' => true,
                ]);
            $fieldset->addField('rating', 'text',
                [
                    'name'     => 'rating',
                    'label'    => __('Movie Rating'),
                    'title'    => __('Movie Rating'),
                    'required' => true,
                    'class' => 'number not-negative-amount'
                ]);
            $fieldset->addField('director_id', 'select',
                [
                    'name'     => 'director_id',
                    'label'    => __('Director'),
                    'title'    => __('Director'),
                    'options'  => $dataArray,
                    'required' => true,
                ]);
        }
        $this->setForm($form);
        return parent::_prepareForm();
    }


    public function getTabLabel()
    {
        return __('Movie information');
    }

    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
