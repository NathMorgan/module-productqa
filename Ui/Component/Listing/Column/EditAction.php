<?php

declare(strict_types=1);

namespace Bright\ProductQA\Ui\Component\Listing\Column;

use Magento\Backend\Ui\Component\Listing\Column\EditAction as BaseEditAction;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class EditAction extends BaseEditAction
{
    /**  @var AuthorizationInterface */
    protected $authorization;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param AuthorizationInterface $authorization
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        array $components = [],
        array $data = [],
    ) {
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $components, $data);

        $this->authorization = $authorization;
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        $dataSource = parent::prepareDataSource($dataSource);
        $actionsName = $this->getData('name');

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (!empty($item[$actionsName]['edit'])) {
                    $item[$actionsName]['edit']['hidden'] =
                        !$this->authorization->isAllowed('Bright_ProductQA::admin_page_edit');
                }
            }
        }

        return $dataSource;
    }
}
