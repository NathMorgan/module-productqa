<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Magento\Framework\Model\AbstractModel;
use Bright\ProductQA\Api\Data\QuestionInterface;

class Question extends AbstractModel implements QuestionInterface
{
    const PRODUCT_QA_CAPTCHA_ID = 'bright_product_qa';

    protected function _construct()
    {
        $this->_init(ResourceModel\Question::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId()
    {
        return $this->getData(self::KEY_ENTTY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($id)
    {
        return $this->setData(self::KEY_ENTTY_ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getProductId()
    {
        return $this->getData(self::KEY_PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId($productId)
    {
        return $this->setData(self::KEY_PRODUCT_ID, $productId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerName()
    {
        return $this->getData(self::KEY_CUSTOMER_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerName($customerName)
    {
        return $this->setData(self::KEY_CUSTOMER_NAME, $customerName);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::KEY_CUSTOMER_EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(self::KEY_CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * @inheritDoc
     */
    public function getQuestion()
    {
        return $this->getData(self::KEY_QUESTION);
    }

    /**
     * @inheritDoc
     */
    public function setQuestion($question)
    {
        return $this->setData(self::KEY_QUESTION, $question);
    }

    /**
     * @inheritDoc
     */
    public function getAnswer()
    {
        return $this->getData(self::KEY_ANSWER);
    }

    /**
     * @inheritDoc
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::KEY_ANSWER, $answer);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::KEY_CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::KEY_CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::KEY_UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::KEY_UPDATED_AT, $updatedAt);
    }

    /**
     * @inheritDoc
     */
    public function getIsApproved()
    {
        return $this->getData(self::KEY_IS_APPROVED);
    }

    /**
     * @inheritDoc
     */
    public function setIsApproved($isApproved)
    {
        return $this->setData(self::KEY_IS_APPROVED, $isApproved);
    }
}
