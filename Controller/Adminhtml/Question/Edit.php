<?php

declare(strict_types=1);

namespace Bright\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\QuestionRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Edit Controller
 */
class Edit extends Action implements HttpGetActionInterface
{
    /** @see _isAllowed() */
    const ADMIN_RESOURCE = 'Bright_ProductQA::admin_page_edit';

    /** @var QuestionRepositoryInterface */
    private $questionRepositoryInterface;

    /**
     * @param Context $context
     * @param QuestionRepositoryInterface $questionRepositoryInterface
     */
    public function __construct(
        Context $context,
        QuestionRepositoryInterface $questionRepositoryInterface
    ) {
        parent::__construct($context);
        $this->questionRepositoryInterface = $questionRepositoryInterface;
    }

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        $questionId = (int)$this->getRequest()->getParam(QuestionInterface::KEY_ENTTY_ID);

        try {
            $question = $this->questionRepositoryInterface->get($questionId);

            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

            $result->setActiveMenu('Bright_ProductQA::admin_page')
                ->addBreadcrumb(__('Edit Question'), __('Edit Question'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Question by Id: %id', ['id' => $question->getEntityId()]));
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Question with id "%value" does not exist.', ['value' => $question->getEntityId()])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
