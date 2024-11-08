<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Bright\ProductQA\Model\Question\Command\DeleteById;
use Bright\ProductQA\Model\Question\Command\Get;
use Bright\ProductQA\Model\Question\Command\GetList;
use Bright\ProductQA\Model\Question\Command\Save;
use Bright\ProductQA\Api\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    /** @var DeleteById */
    protected $deleteById;

    /** @var Get */
    protected $get;

    /** @var GetList */
    protected $getList;

    /** @var Save */
    protected $save;

    public function __construct(
        DeleteById $deleteById,
        Get $get,
        GetList $getList,
        Save $save
    ) {
        $this->deleteById = $deleteById;
        $this->get = $get;
        $this->getList = $getList;
        $this->save = $save;
    }

    /**
     * @inheritdoc
     */
    public function save(
        \Bright\ProductQA\Api\Data\QuestionInterface $question,
        bool $shouldNotifyEmail = false
    ): int {
        return $this->save->execute($question, $shouldNotifyEmail);
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
