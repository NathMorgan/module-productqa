<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Data;

use Bright\ProductQA\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

class QuestionSearchResults extends SearchResults implements QuestionSearchResultsInterface
{
}
