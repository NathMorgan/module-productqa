<?php

namespace Bright\ProductQA\ViewModel\Product\View;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Bright\ProductQA\Model\ResourceModel\Question\Collection as QuestionCollection;
use Bright\ProductQA\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

class QuestionViewModel implements ArgumentInterface
{
    protected QuestionCollectionFactory $questionCollectionFactory;

    /** @var QuestionCollection */
    protected $questionsCollection;

    /**
     * @param QuestionCollectionFactory $questionCollectionFactory
     */
    public function __construct(
        QuestionCollectionFactory $questionCollectionFactory,
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
    }

    /**
     * Get all question collection
     *
     * @param int $productId
     * @return QuestionCollection
     */
    public function getAllQuestionsByProductIdCollection(int $productId): QuestionCollection
    {
        if ($this->questionsCollection === null) {
            $this->questionsCollection = $this->questionCollectionFactory->create();

            $this->questionsCollection->addFilter(
                'product_id',
                $productId
            );
        }

        return $this->questionsCollection;
    }
}
