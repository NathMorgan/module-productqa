<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Bright\ProductQA\Model\Question\Command\DeleteById;
use Bright\ProductQA\Model\Question\Command\Get;
use Bright\ProductQA\Model\Question\Command\GetList;
use Bright\ProductQA\Model\Question\Command\Save;

class QuestionRepository implements \Bright\ProductQA\Api\QuestionRepositoryInterface
{
    /** @var DeleteById */
    protected DeleteById $deleteById;

    /** @var Get */
    protected Get $get;

    /** @var GetList */
    protected GetList $getList;

    /** @var Save */
    protected Save $save;

    public function __construct(
        DeleteById $deleteById,
        Get $get,
        GetList $getList,
        Save $save,
    ) {
        $this->deleteById = $deleteById;
        $this->get = $get;
        $this->getList = $getList;
        $this->save = $save;
    }

    /**
     * @inheritdoc
     */
    public function save(\Bright\ProductQA\Api\Data\QuestionInterface $question): int
    {
        return $this->save->execute($question);
    }

    /**
     * @inheritdoc
     */
    public function get($questionId): \Bright\ProductQA\Api\Data\QuestionInterface
    {
        return $this->get->execute($questionId);
    }

    /**
     * @inheritdoc
     */
    public function deleteById($questionId): bool
    {
        return $this->deleteById->execute($questionId);
    }

    /**
     * @inheritdoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ): \Bright\ProductQA\Api\Data\QuestionSearchResultsInterface {
        return $this->getList->execute($searchCriteria);
    }
}
