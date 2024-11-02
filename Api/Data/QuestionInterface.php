<?php

declare(strict_types=1);

namespace Bright\ProductQA\Api\Data;

interface QuestionInterface
{
    const KEY_ENTTY_ID = 'entity_id';
    const KEY_PRODUCT_ID = 'product_id';
    const KEY_CUSTOMER_NAME= 'customer_name';
    const KEY_CUSTOMER_EMAIL = 'customer_email';
    const KEY_QUESTION = 'question';
    const KEY_ANSWER = 'answer';
    const KEY_CREATED_AT = 'created_at';
    const KEY_UPDATED_AT = 'updated_at';
    const KEY_IS_APPROVED = 'is_approved';

    /**
     * Get question id.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set question id.
     *
     * @param int $id
     * @return $this
     */
    public function setEntityId($id);

    /**
     * Get product id
     *
     * @return int|null
     */
    public function getProductId();

    /**
     * Set product id
     *
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * Get customer name
     *
     * @return string|null
     */
    public function getCustomerName();

    /**
     * Set customer name
     *
     * @param string $customerName
     * @return $this
     */
    public function setCustomerName($customerName);

    /**
     * Get customer email
     *
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * Set customer email
     *
     * @param string $customerEmail
     * @return $this
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion($question);

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer($answer);

    /**
     * Get created at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get is approved
     *
     * @return boolean|null
     */
    public function getIsApproved();

    /**
     * Set is approved
     *
     * @param bool $isApproved
     * @return $this
     */
    public function setIsApproved($isApproved);
}
