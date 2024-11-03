<?php

declare(strict_types=1);

namespace Bright\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Delete Controller
 */
class Delete extends Action implements HttpPostActionInterface
{
    /** @see _isAllowed() */
    const ADMIN_RESOURCE = 'Bright_ProductQA::admin_page_delete';

    /** @var QuestionRepositoryInterface */
    private $questionRepository;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepository
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $questionId = $this->getRequest()->getPost(QuestionInterface::KEY_ENTTY_ID);
        if ($questionId === null) {
            $this->messageManager->addErrorMessage(__('Missing required data please try again.'));
            return $resultRedirect->setPath('*/*');
        }

        try {
            $questionId = (int)$questionId;
            $this->questionRepository->deleteById($questionId);
            $this->messageManager->addSuccessMessage(__('The Question has been deleted.'));
            $resultRedirect->setPath('*/*');
        } catch (CouldNotDeleteException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $resultRedirect->setPath('*/*/edit', [
                QuestionInterface::KEY_ENTTY_ID => $questionId,
                '_current' => true,
            ]);
        }

        return $resultRedirect;
    }
}
