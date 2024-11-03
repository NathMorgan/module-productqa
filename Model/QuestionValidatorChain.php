<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Magento\Framework\Validation\ValidationResult;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validation\ValidationResultFactory;

class QuestionValidatorChain implements QuestionValidatorInterface
{
    /** @var ValidationResultFactory */
    protected $validationResultFactory;

    /** @var QuestionValidatorInterface[] */
    protected $validators;

    /**
     * @param ValidationResultFactory $validationResultFactory
     * @param QuestionValidatorInterface[] $validators
     * @throws LocalizedException
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        array $validators = []
    ) {
        $this->validationResultFactory = $validationResultFactory;

        // Check that validators are part of implemented class to prevent runtime errors
        foreach ($validators as $validator) {
            if (!$validator instanceof QuestionValidatorInterface) {
                throw new LocalizedException(
                    __('Question Validator must implement QuestionValidatorInterface.')
                );
            }
        }
        $this->validators = $validators;
    }
    public function validate(QuestionInterface $question): ValidationResult
    {
        $errors = [[]];

        // Loop though all validators defined in di.xml
        foreach ($this->validators as $validator) {
            $validationResult = $validator->validate($question);

            if (!$validationResult->isValid()) {
                $errors[] = $validationResult->getErrors();
            }
        }

        $errors = array_merge(...$errors);

        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
