<?php

namespace Alliance\Developers2\Model\ResourceModel;

use Alliance\Developers2\Api\Data\SignupInterface;
use Alliance\Developers2\Api\SignupRepositoryInterface;
use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Alliance\Developers2\Model\ResourceModel\Signup as SignupResource;
use Alliance\Developers2\Api\Data\SignupInterfaceFactory;
use Magento\Framework\Exception\AlreadyExistsException;

class SignupRepository implements SignupRepositoryInterface
{
    protected SignupResource $signupResource;

    protected SignupInterfaceFactory $signupInterfaceFactory;

    /**
     * @param Signup $signupResource
     * @param SignupInterfaceFactory $signupInterfaceFactory
     */
    public function __construct(
        SignupResource $signupResource,
        SignupInterfaceFactory $signupInterfaceFactory
    )
    {
        $this->signupResource = $signupResource;
        $this->signupInterfaceFactory = $signupInterfaceFactory;
    }

    /**
     * @param SignupInterface $object
     * @return void
     * @throws AlreadyExistsException
     */
    public function save(SignupInterface $object): void
    {
        $this->signupResource->save($object);
    }

    /**
     * @param int $signupId
     * @return SignupInterface
     */
    public function get(int $signupId): SignupInterface
    {
        $object = $this->signupInterfaceFactory->create();
        $this->signupResource->load($object, $signupId, 'signup_id');
    }

    /**
     * @param SignupInterface $object
     * @return void
     * @throws Exception
     */
    public function delete(SignupInterface $object): void
    {
        $this->signupResource->delete($object);
    }

    /**
     * @param int $signupId
     * @return void
     * @throws Exception
     */
    public function deleteById(int $signupId): void
    {
        $object = $this->get($signupId);
        $this->delete($object);
    }
}
