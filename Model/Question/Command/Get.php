<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Command;

use Magento\Framework\Exception\NoSuchEntityException;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResourceModel;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\Data\QuestionInterfaceFactory;

class Get
{
    /** @var QuestionResourceModel */
    protected QuestionResourceModel $questionResourceModel;

    /** @var QuestionInterfaceFactory */
    protected QuestionInterfaceFactory $questionInterfaceFactory;

    /**
     * @param QuestionResourceModel $questionResourceModel
     * @param SourceInterfaceFactory $sourceFactory
     */
    public function __construct(
        QuestionResourceModel $questionResourceModel,
        QuestionInterfaceFactory $questionInterfaceFactory
    ) {
        $this->questionResourceModel = $questionResourceModel;
        $this->questionInterfaceFactory = $questionInterfaceFactory;
    }

    /**
     * Find question by given question id
     *
     * @param int $questionId
     * @return QuestionInterface
     * @throws NoSuchEntityException
     */
    public function execute(int $questionId): QuestionInterface
    {
        /** @var QuestionInterface $question */
        $question = $this->questionInterfaceFactory->create();
        $this->questionResourceModel->load($question, $questionId);

        if (null === $question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%id" does not exist.', ['id' => $questionId]));
        }

        return $question;
    }
}
