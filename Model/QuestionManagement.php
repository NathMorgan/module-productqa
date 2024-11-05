<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model;

use Magento\Framework\Encryption\Helper\Security;
use Magento\Framework\Data\Form\FormKey;
use Bright\ProductQA\Api\QuestionManagementInterface;
use Bright\ProductQA\Api\QuestionRepositoryInterface;
use Bright\ProductQA\Api\Data\QuestionMessageInterface;
use Bright\ProductQA\Api\Data\QuestionMessageInterfaceFactory;
use Magento\Framework\Validation\ValidationException;

class QuestionManagement implements QuestionManagementInterface
{
    /** @var FormKey  */
    protected $formKey;

    /** @var QuestionRepositoryInterface */
    protected $questionRepository;

    /** @var QuestionMessageInterfaceFactory */
    protected $questionMessageFactory;

    /**
     * @param FormKey $formKey
     * @param QuestionRepositoryInterface $questionRepository
     * @param QuestionMessageInterfaceFactory $questionMessageFactory
     */
    public function __construct(
        FormKey $formKey,
        QuestionRepositoryInterface $questionRepository,
        QuestionMessageInterfaceFactory $questionMessageFactory
    ) {
        $this->formKey = $formKey;
        $this->questionRepository = $questionRepository;
        $this->questionMessageFactory = $questionMessageFactory;
    }

    /**
     * @inheritdoc
     */
    public function create(
        \Bright\ProductQA\Api\Data\QuestionInterface $question,
        string $formKey
    ): \Bright\ProductQA\Api\Data\QuestionMessageInterface {
        /** @var QuestionMessageInterface $questionMessage */
        $questionMessage = $this->questionMessageFactory->create();

        if (!$this->validateFormKey($formKey)) {
            $questionMessage->setSuccess(false);
            $questionMessage->setMessage(__('Invalid Form Key. Please refresh the page.'));
            return $questionMessage;
        }

        try {
            // Prevent this from being an update
            $question->setEntityId(null);
            $this->questionRepository->save($question);
        } catch (ValidationException $e) {
            $validationExceptions = $e->getErrors();
            $validationErrorMessages = [];

            foreach ($validationExceptions as $validationException) {
                $validationErrorMessages[] = $validationException->getMessage();
            }

            $questionMessage->setSuccess(false);
            $questionMessage->setMessage(__(implode("\n", $validationErrorMessages)));

            return $questionMessage;
        } catch(\Exception $e) {
            $questionMessage->setSuccess(false);
            $questionMessage->setMessage(__($e->getMessage()));

            return $questionMessage;
        }

        $questionMessage->setSuccess(true);
        $questionMessage->setMessage(__('Question submitted successfully.'));

        return $questionMessage;
    }

    /**
     * Validate form key based on how Magento deal with it in core functionality
     *
     * @param string $formKey
     * @return bool
     */
    private function validateFormKey(string $formKey): bool
    {
        return $formKey && Security::compareStrings($formKey, $this->formKey->getFormKey());
    }
}
