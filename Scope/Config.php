<?php

declare(strict_types=1);

namespace Bright\ProductQA\Scope;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    protected const string XML_PATH_PRODUCTQA_ADMIN_NOTIFICATION_EMAIL = 'productqa/general/admin_notification_email';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getAdminNotificationEmail(): string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_PRODUCTQA_ADMIN_NOTIFICATION_EMAIL) ?? '';
    }
}
