<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Command;

use Bright\ProductQA\Model\QuestionValidatorChain;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResourceModel;
use Bright\ProductQA\Api\Data\QuestionInterface;

use Psr\Log\LoggerInterface;

class Save
{
    /** @var QuestionResourceModel */
    protected $questionResourceModel;

    /** @var QuestionValidatorChain */
    protected $questionValidator;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param QuestionResourceModel $questionResourceModel
     * @param QuestionValidatorChain $questionValidator
     * @param LoggerInterface $logger
     */
    public function __construct(
        QuestionResourceModel $questionResourceModel,
        QuestionValidatorChain $questionValidator,
        LoggerInterface $logger
    ) {
        $this->questionResourceModel = $questionResourceModel;
        $this->questionValidator = $questionValidator;
        $this->logger = $logger;
    }

    /**
     * Save Question data
     *
     * @param QuestionInterface $question
     * @return int
     * @throws ValidationException
     * @throws CouldNotSaveException
     */
    public function execute(QuestionInterface $question): int
    {
        $validationResult = $this->questionValidator->validate($question);
        if (!$validationResult->isValid()) {
            throw new ValidationException(__('Validation Failed'), null, 0, $validationResult);
        }

        try {
            $this->questionResourceModel->save($question);
            return (int) $question->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Question'), $e);
        }
    }
}
