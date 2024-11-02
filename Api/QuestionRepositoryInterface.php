<?php

declare(strict_types=1);

namespace Bright\ProductQA\Api;

interface QuestionRepositoryInterface
{
    /**
     * Save question data
     *
     * @param \Bright\ProductQA\Api\Data\QuestionInterface $question
     * @return \Bright\ProductQA\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(
        \Bright\ProductQA\Api\Data\QuestionInterface $question
    ): int;

    /**
     * Get question data by question_id
     *
     * @param int $questionId
     * @param bool $forceReload
     * @return \Bright\ProductQA\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get(
        $questionId
    ): \Bright\ProductQA\Api\Data\QuestionInterface;

    /**
     * Find questions by given SearchCriteria
     * SearchCriteria is not required because load all question is useful case
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Bright\ProductQA\Api\Data\QuestionSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ): \Bright\ProductQA\Api\Data\QuestionSearchResultsInterface;

    /**
     * Delete question by identifier
     *
     * @param int $questionId
     * @return bool
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($questionId): bool;
}
