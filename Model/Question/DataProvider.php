<?php

namespace Bright\ProductQA\Model\Question;

use Bright\ProductQA\Model\Question;
use Bright\ProductQA\Model\ResourceModel\Question\Collection as QuestionCollection;
use Bright\ProductQA\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    /** @var QuestionCollection */
    protected $collection;

    /** @var QuestionCollectionFactory */
    protected $questionCollectionFactory;

    /** @var array */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        QuestionCollectionFactory $questionCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $questionCollectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $questions = $this->collection->getItems();

        /** @var Question $question */
        foreach ($questions as $question) {
            $this->loadedData[$question->getEntityId()] = $question->getData();
        }

        return $this->loadedData;
    }
}
