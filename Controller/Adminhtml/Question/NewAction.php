<?php

declare(strict_types=1);

namespace Bright\ProductQA\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * New Action Controller
 */
class NewAction extends Action implements HttpGetActionInterface
{
    /** @see _isAllowed() */
    const ADMIN_RESOURCE = 'Magento_InventoryApi::admin_page_edit';

    /**
     * @inheritdoc
     */
    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Bright_ProductQA::admin_page');
        $resultPage->getConfig()->getTitle()->prepend(__('New Question'));

        return $resultPage;
    }
}
