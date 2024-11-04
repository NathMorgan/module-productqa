<?php

declare(strict_types=1);

namespace Bright\ProductQA\Model\ReCaptcha;

use Bright\ProductQA\Api\QuestionManagementInterface;
use Bright\ProductQA\Model\Question;
use Magento\ReCaptchaWebapiApi\Api\Data\EndpointInterface;
use Magento\ReCaptchaWebapiApi\Api\WebapiValidationConfigProviderInterface;
use Magento\ReCaptchaUi\Model\IsCaptchaEnabledInterface;
use Magento\ReCaptchaUi\Model\ValidationConfigResolverInterface;
use Magento\ReCaptchaValidationApi\Api\Data\ValidationConfigInterface;

class WebapiConfigProvider implements WebapiValidationConfigProviderInterface
{
    /** @var IsCaptchaEnabledInterface */
    protected $isEnabled;

    /** @var ValidationConfigResolverInterface */
    protected $configResolver;

    /**
     * @param IsCaptchaEnabledInterface $isEnabled
     * @param ValidationConfigResolverInterface $configResolver
     */
    public function __construct(
        IsCaptchaEnabledInterface $isEnabled,
        ValidationConfigResolverInterface $configResolver
    ) {
        $this->isEnabled = $isEnabled;
        $this->configResolver = $configResolver;
    }

    /**
     * @inheritDoc
     */
    public function getConfigFor(EndpointInterface $endpoint): ?ValidationConfigInterface
    {
        if ($endpoint->getServiceClass() === QuestionManagementInterface::class
            && $this->isEnabled->isCaptchaEnabledFor(Question::PRODUCT_QA_CAPTCHA_ID)) {
            return $this->configResolver->get(Question::PRODUCT_QA_CAPTCHA_ID);
        }

        return null;
    }
}
