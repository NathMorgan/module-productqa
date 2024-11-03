<?php

namespace Bright\ProductQA\Model\Question\Email;


use Magento\Backend\Model\UrlInterface as BackendUrlInterface;
use Magento\Framework\App\Area;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Bright\ProductQA\Scope\Config as ScopeConfig;

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

    /**
     * @param ScopeConfig $scopeConfig
     * @param BackendUrlInterface $backendUrl
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfig $scopeConfig,
        BackendUrlInterface $backendUrl,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->backendUrl = $backendUrl;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
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
            var_dump($e->getMessage());die;
        }
    }
}
