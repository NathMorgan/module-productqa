<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Question\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Magento\Framework\Validator\EmailAddress as EmailAddressValidator;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Model\QuestionValidatorInterface;

/**
 * Check that customer email is valid
 */
class CustomerEmailValidator implements QuestionValidatorInterface
{
    /** @var ValidationResultFactory */
    protected $validationResultFactory;

    /** @var EmailAddressValidator */
    protected $emailAddressValidator;

    /**
     * @param ValidationResultFactory $validationResultFactory
     * @param EmailAddressValidator $emailAddressValidator
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        EmailAddressValidator $emailAddressValidator
    ) {
        $this->validationResultFactory = $validationResultFactory;
        $this->emailAddressValidator = $emailAddressValidator;
    }

    /**
     * @inheritdoc
     */
    public function validate(QuestionInterface $question): ValidationResult
    {
        $errors = [];
        $value = (string) $question->getCustomerEmail();

        if (trim($value) === '') {
            $errors[] = __('Email is a required field.');
        }

        if (!$this->emailAddressValidator->isValid($question->getCustomerEmail())) {
            $errors[] = __('Provided email is not a valid email address.');
        }

        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
