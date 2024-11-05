<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Command;

use Bright\ProductQA\Model\QuestionValidatorChain;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResourceModel;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Model\Question\Email\Notification as EmailNotification;
use Psr\Log\LoggerInterface;

class Save
{
    /** @var QuestionResourceModel */
    protected $questionResourceModel;

    /** @var QuestionValidatorChain */
    protected $questionValidator;

    /** @var EmailNotification */
    protected $emailNotification;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param QuestionResourceModel $questionResourceModel
     * @param QuestionValidatorChain $questionValidator
     * @param EmailNotification $emailNotification
     * @param LoggerInterface $logger
     */
    public function __construct(
        QuestionResourceModel $questionResourceModel,
        QuestionValidatorChain $questionValidator,
        EmailNotification $emailNotification,
        LoggerInterface $logger,
    ){
        $this->questionResourceModel = $questionResourceModel;
        $this->questionValidator = $questionValidator;
        $this->emailNotification = $emailNotification;
        $this->logger = $logger;
    }

    /**
     * Save Question data
     *
     * @param QuestionInterface $question
     * @param bool $shouldNotifyEmail
     * @return int
     * @throws ValidationException
     * @throws CouldNotSaveException
     */
    public function execute(QuestionInterface $question, bool $shouldNotifyEmail): int
    {
        $validationResult = $this->questionValidator->validate($question);
        if (!$validationResult->isValid()) {
            throw new ValidationException(__('Validation Failed'), null, 0, $validationResult);
        }

        try {
            $this->questionResourceModel->save($question);

            // Only send notification email if set
            if ($shouldNotifyEmail) {
                $this->emailNotification->questionSubmittedAdmin((int) $question->getEntityId());
            }

            return (int) $question->getId();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__('Could not save Question'), $e);
        }
    }
}
