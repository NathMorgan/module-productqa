<?php

declare(strict_types=1);

namespace Bright\ProductQA\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get questions
     *
     * @return \Bright\ProductQA\Api\Data\QuestionInterface[]
     */
    public function getItems();

    /**
     * Set questions
     *
     * @param \Bright\ProductQA\Api\Data\QuestionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
