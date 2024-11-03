<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Magento\Framework\Validation\ValidationResult;
use Bright\ProductQA\Api\Data\QuestionInterface;

interface QuestionValidatorInterface
{
    /**
     * @param QuestionInterface $question
     * @return ValidationResult
     */
    public function validate(QuestionInterface $question): ValidationResult;
}
