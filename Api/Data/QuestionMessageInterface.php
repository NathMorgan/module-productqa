<?php

declare(strict_types=1);

namespace Bright\ProductQA\Api\Data;

use Magento\Framework\Phrase;

interface QuestionMessageInterface
{
    /**
     * Get success
     *
     * @return bool
     */
    public function getSuccess(): bool;

    /**
     * Set success
     *
     * @param bool $success
     * @return void
     */
    public function setSuccess(bool $success): void;

    /**
     * Set message
     *
     * @param Phrase $message
     * @return void
     */
    public function setMessage(Phrase $message): void;

    /**
     * Get message
     *
     * @return Phrase
     */
    public function getMessage(): Phrase;
}
