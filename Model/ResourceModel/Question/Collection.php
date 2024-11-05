<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Bright\ProductQA\Model\Question as QuestionModel;
use Bright\ProductQA\Model\ResourceModel\Question as ResourceQuestion;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = 'entity_id';

    public function _construct(): void
    {
        $this->_init(
            QuestionModel::class,
            ResourceQuestion::class
        );
    }

    /**
     * Add is approved question filter
     *
     * @return $this
     */
    public function addIsApprovedFilter(): static
    {
        $this->addFilter('is_approved', 1);

        return $this;
    }
}
