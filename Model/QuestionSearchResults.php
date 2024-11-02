<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Magento\Framework\Api\SearchResults;
use Bright\ProductQA\Api\Data\QuestionSearchResultsInterface;

class QuestionSearchResults extends SearchResults implements QuestionSearchResultsInterface
{
}
