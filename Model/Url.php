<?php

namespace Alliance\Developers2\Model;

use Magento\Framework\UrlInterface;

class Url
{
    protected UrlInterface $urlBuilder;

    /**
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        UrlInterface $urlBuilder
    )
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @return string
     */
    public function getSignupPostUrl(): string
    {
        return $this->urlBuilder->getUrl('signup/index/createpost');
    }
}
