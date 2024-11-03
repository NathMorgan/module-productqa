<?php

declare(strict_types=1);

namespace Bright\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResourceModel;

/**
 * Index Controller
 */
class Index extends Action
{
    /** @see _isAllowed() */
    const ADMIN_RESOURCE = 'Bright_ProductQA::admin_page_view_list';

    /** @var PageFactory */
    protected $resultPageFactory;

    /** @var QuestionResourceModel */
    protected $questionResourceModel;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param QuestionResourceModel $questionResourceModel
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        QuestionResourceModel $questionResourceModel
    ) {
        parent::__construct($context);

        $this->resultPageFactory = $resultPageFactory;
        $this->questionResourceModel = $questionResourceModel;
    }

    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Product Q&A"));
        return $resultPage;
    }
}
