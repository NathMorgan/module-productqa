<?php

declare(strict_types=1);

namespace Bright\ProductQA\Api;

interface QuestionManagementInterface
{
    /**
     * Create public question data
     *
     * @param \Bright\ProductQA\Api\Data\QuestionInterface $question
     * @param string $formKey
     * @return \Bright\ProductQA\Api\Data\QuestionMessageInterface
     * @throws \Magento\Framework\Validation\ValidationException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function create(
        \Bright\ProductQA\Api\Data\QuestionInterface $question,
        string $formKey
    ): \Bright\ProductQA\Api\Data\QuestionMessageInterface;
}
