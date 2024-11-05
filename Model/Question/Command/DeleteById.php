<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Command;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResourceModel;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\Data\QuestionInterfaceFactory;

class DeleteById
{
    /** @var QuestionResourceModel */
    protected QuestionResourceModel $questionResourceModel;

    /** @var QuestionInterfaceFactory */
    protected QuestionInterfaceFactory $questionInterfaceFactory;

    /**
     * @param QuestionResourceModel $questionResourceModel
     * @param QuestionInterfaceFactory $questionInterfaceFactory
     */
    public function __construct(
        QuestionResourceModel $questionResourceModel,
        QuestionInterfaceFactory $questionInterfaceFactory
    ){
        $this->questionResourceModel = $questionResourceModel;
        $this->questionInterfaceFactory = $questionInterfaceFactory;
    }

    /**
     * Delete Question by identifier
     *
     * @param int $questionId
     * @return bool
     * @throws NoSuchEntityException
     */
    public function execute(int $questionId): bool
    {
        /** @var QuestionInterface $question */
        $question = $this->questionInterfaceFactory->create();

        $this->questionResourceModel->load($question, $questionId);

        if ($question->getId() === null) {
            throw new NoSuchEntityException(__('Question with id "%id" does not exist.', ['id' => $questionId]));
        }

        try {
            $this->questionResourceModel->delete($question);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__('Could not delete Question'), $e);
        }

        return true;
    }
}
