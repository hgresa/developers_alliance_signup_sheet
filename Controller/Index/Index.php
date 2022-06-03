<?php

namespace Alliance\Developers2\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Alliance\Developers2\Model\Config\Config;
use Magento\Framework\Message\ManagerInterface;

class Index implements HttpGetActionInterface
{
    protected PageFactory $pageFactory;

    protected Config $config;

    protected ManagerInterface $messageManager;

    /**
     * @param PageFactory $pageFactory
     * @param Config $config
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        PageFactory $pageFactory,
        Config $config,
        ManagerInterface $messageManager
    )
    {
        $this->pageFactory = $pageFactory;
        $this->config = $config;
        $this->messageManager = $messageManager;
    }

    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        if (!$this->config->getFormIsVisible()) {
            $this->messageManager->addErrorMessage('Form not enabled');
        }

        return $this->pageFactory->create();
    }
}
