<?php

namespace Alliance\Developers2\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Alliance\Developers2\Api\Data\SignupInterfaceFactory;
use Alliance\Developers2\Api\SignupRepositoryInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Message\ManagerInterface;

class CreatePost implements HttpPostActionInterface
{
    protected SignupInterfaceFactory $signupInterfaceFactory;

    protected SignupRepositoryInterface $signupRepository;

    protected DataPersistorInterface $dataPersistor;

    protected RedirectFactory $redirectFactory;

    protected RequestInterface $request;

    protected ManagerInterface $messageManager;

    private array $errors = [];

    /**
     * @param SignupInterfaceFactory $signupInterfaceFactory
     * @param SignupRepositoryInterface $signupRepository
     * @param DataPersistorInterface $dataPersistor
     * @param RedirectFactory $redirectFactory
     * @param RequestInterface $request
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        SignupInterfaceFactory    $signupInterfaceFactory,
        SignupRepositoryInterface $signupRepository,
        DataPersistorInterface    $dataPersistor,
        RedirectFactory           $redirectFactory,
        RequestInterface          $request,
        ManagerInterface          $messageManager
    )
    {
        $this->signupInterfaceFactory = $signupInterfaceFactory;
        $this->signupRepository = $signupRepository;
        $this->dataPersistor = $dataPersistor;
        $this->redirectFactory = $redirectFactory;
        $this->request = $request;
        $this->messageManager = $messageManager;
    }

    /**
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $request = $this->request;
        $redirect = $this->redirectFactory->create();

        if (!$request->isPost()) {
            return $this->redirectFactory->create()->setPath('*/*/');
        }

        $name = $request->getParam('name');
        $date = $request->getParam('date');

        if ($this->validateParams()) {
            $date = date_create($date)->format('Y-m-d');

            $signupObject = $this->signupInterfaceFactory->create();

            $signupObject->setName($name);
            $signupObject->setDate($date);

            $this->signupRepository->save($signupObject);

            $this->messageManager->addSuccessMessage('Your record has been successfully saved');

            return $redirect->setRefererUrl();
        }

        $this->dataPersistor->set('signupName', $name);
        $this->dataPersistor->set('signupDate', $date);

        foreach ($this->getErrors() as $errorMessage) {
            $this->messageManager->addErrorMessage($errorMessage);
        }

        return $redirect->setRefererUrl();
    }

    /**
     * @return bool
     */
    public function validateParams(): bool
    {
        $request = $this->request;

        if (trim($request->getParam('name')) === '') {
            $this->errors[] = __('Name is a required field');
        }

        if (trim($request->getParam('date')) === '') {
            $this->errors[] = __('Date is a required field');
        }

        if ($this->errors) {
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
