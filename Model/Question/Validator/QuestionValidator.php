<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Model\QuestionValidatorInterface;

/**
 * Check that question is valid
 */
class QuestionValidator implements QuestionValidatorInterface
{
    /** @var ValidationResultFactory */
    protected $validationResultFactory;

    /**
     * @param ValidationResultFactory $validationResultFactory
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory
    ) {
        $this->validationResultFactory = $validationResultFactory;
    }

    /**
     * @inheritdoc
     */
    public function validate(QuestionInterface $question): ValidationResult
    {
        $errors = [];
        $value = (string) $question->getQuestion();

        if (!$value) {
            $errors[] = __('Question is a required field.');
        }

        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
