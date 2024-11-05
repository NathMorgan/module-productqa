<?php

declare(strict_types=1);

namespace Bright\ProductQA\Controller\Adminhtml\Question;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Validation\ValidationException;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\Data\QuestionInterfaceFactory;
use Bright\ProductQA\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Save Controller
 */
class Save extends Action implements HttpPostActionInterface
{
    /** @see _isAllowed() */
    const ADMIN_RESOURCE = 'Bright_ProductQA::admin_page_edit';

    /** @var DataObjectHelper */
    protected $dataObjectHelper;

    /** @var QuestionRepositoryFactory */
    protected $questionRepositoryFactory;

    /** @var QuestionRepository */
    protected $questionRepository;

    /**
     * @param Context $context
     * @param DataObjectHelper $dataObjectHelper
     * @param QuestionInterfaceFactory $questionRepositoryFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        DataObjectHelper $dataObjectHelper,
        QuestionInterfaceFactory $questionRepositoryFactory,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->dataObjectHelper = $dataObjectHelper;
        $this->questionRepositoryFactory = $questionRepositoryFactory;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $requestData = $request->getParams();

        if (!$request->isPost()) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            $this->processRedirectAfterFailureSave($resultRedirect);
            return $resultRedirect;
        }

        return $this->processSave($requestData, $resultRedirect);
    }

    /**
     * Save question
     *
     * @param array $requestData
     * @param Redirect $resultRedirect
     * @return ResultInterface
     */
    private function processSave(
        array $requestData,
        Redirect $resultRedirect
    ): ResultInterface {
        try {
            $questionId = isset($requestData[QuestionInterface::KEY_ENTTY_ID])
                ? (int)$requestData[QuestionInterface::KEY_ENTTY_ID]
                : null;

            /** @var QuestionInterface $question */
            $question = $this->questionRepositoryFactory->create();

            // Populate interface and save
            $this->dataObjectHelper->populateWithArray($question, $requestData, QuestionInterface::class);
            $this->questionRepository->save($question);

            $this->messageManager->addSuccessMessage(__('The Question has been saved.'));

            $resultRedirect->setPath('*/*/');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('The Question does not exist.'));
            $this->processRedirectAfterFailureSave($resultRedirect);
        } catch (ValidationException $e) {
            foreach ($e->getErrors() as $localizedError) {
                $this->messageManager->addErrorMessage($localizedError->getMessage());
            }
            $this->processRedirectAfterFailureSave($resultRedirect, $questionId);
        } catch (CouldNotSaveException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->processRedirectAfterFailureSave($resultRedirect, $questionId);
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Could not save Question.'));
            $this->processRedirectAfterFailureSave($resultRedirect, $questionId ?? null);
        }

        return $resultRedirect;
    }

    /**
     * Process result redirect after failed save.
     *
     * @param Redirect $resultRedirect
     * @param int|null $questionId
     *
     * @return void
     */
    private function processRedirectAfterFailureSave(Redirect $resultRedirect, int $questionId = null): void
    {
        if ($questionId === null) {
            $resultRedirect->setPath('*/*/new');
        } else {
            $resultRedirect->setPath('*/*/edit', [
                QuestionInterface::KEY_ENTTY_ID => $questionId,
                '_current' => true,
            ]);
        }
    }
}
