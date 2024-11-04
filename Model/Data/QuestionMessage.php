<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\Data;

use Magento\Framework\Phrase;
use Bright\ProductQA\Api\Data\QuestionMessageInterface;

class QuestionMessage implements QuestionMessageInterface
{
    /** @var Phrase */
    private Phrase $message;

    /** @var bool */
    private bool $success;

    /**
     * @inheritDoc
     */
    public function setMessage(Phrase $message): void
    {
        $this->message = $message;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): Phrase
    {
        return $this->message;
    }

    /**
     * @inheritDoc
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @inheritDoc
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
}
