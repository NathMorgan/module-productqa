<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
use Bright\ProductQA\Api\Data\QuestionInterfaceFactory;
use Bright\ProductQA\Api\Data\QuestionSearchResultsInterface;
use Bright\ProductQA\Api\Data\QuestionSearchResultsInterfaceFactory;
use Bright\ProductQA\Model\ResourceModel\Question\Collection as QuestionCollection;
use Bright\ProductQA\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class GetList
{
    /** @var CollectionProcessorInterface */
    protected CollectionProcessorInterface $collectionProcessor;

    /** @var QuestionCollectionFactory */
    protected QuestionCollectionFactory $questionCollectionFactory;

    /** @var QuestionSearchResultsInterfaceFactory $questionSearchResultsFactory */
    protected QuestionSearchResultsInterfaceFactory $questionSearchResultsFactory;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        CollectionProcessorInterface $collectionProcessor,
        QuestionCollectionFactory $questionCollectionFactory,
        QuestionSearchResultsInterfaceFactory $questionSearchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->questionCollectionFactory = $questionCollectionFactory;
        $this->questionSearchResultsFactory = $questionSearchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Find Questions by given SearchCriteria
     * SearchCriteria is not required because load all Questions is useful case
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return QuestionSearchResultsInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): QuestionSearchResultsInterface
    {
        /** @var QuestionCollection $collection */
        $collection = $this->questionCollectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        /** @var QuestionSearchResultsInterface $searchResult */
        $searchResult = $this->questionSearchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
