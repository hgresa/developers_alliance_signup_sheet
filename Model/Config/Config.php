<?php

namespace Alliance\Developers2\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    public const XML_PATH_SIGNUP_FORM_IS_VISIBLE = 'custom_signup/general/signup_form_is_visible';

    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function getFormIsVisible(): bool
    {
        return $this->scopeConfig->getValue(self::XML_PATH_SIGNUP_FORM_IS_VISIBLE);
    }
}
