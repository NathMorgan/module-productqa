<?php

namespace Bright\ProductQA\Model\Question\Email;

use Magento\Backend\Model\UrlInterface as BackendUrlInterface;
use Magento\Framework\App\Area;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Bright\ProductQA\Scope\Config as ScopeConfig;
use Psr\Log\LoggerInterface;

class Notification
{
    /** @var ScopeConfig */
    protected $scopeConfig;

    /** @var BackendUrlInterface */
    protected $backendUrl;

    /** @var TransportBuilder */
    protected $transportBuilder;

    /** @var StoreManagerInterface */
    protected $storeManager;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * @param ScopeConfig $scopeConfig
     * @param BackendUrlInterface $backendUrl
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        ScopeConfig $scopeConfig,
        BackendUrlInterface $backendUrl,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->backendUrl = $backendUrl;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    /**
     * Send question submitted notification to configured email
     *
     * @param int $questionId
     * @return void
     */
    public function questionSubmittedAdmin(): void
    {
        try {
            $storeId = $this->storeManager->getStore()->getId();

            $transport = $this->transportBuilder
                ->setTemplateIdentifier('admin_productqa_notification_email_template')
                ->setTemplateOptions(
                    [
                        'area' => Area::AREA_ADMINHTML,
                        'store' => $storeId
                    ]
                )
                ->setTemplateVars([])
                ->setFromByScope(
                    $this->scopeConfig->getSenderEmail()
                )
                ->addTo(
                    $this->scopeConfig->getRequestEmail()
                )
                ->getTransport();

            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}
