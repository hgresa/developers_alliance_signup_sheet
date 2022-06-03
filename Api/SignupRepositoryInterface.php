<?php

namespace Alliance\Developers2\Api;

use Alliance\Developers2\Api\Data\SignupInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface SignupRepositoryInterface
{
    /**
     * @param SignupInterface $object
     * @return mixed
     */
    public function save(SignupInterface $object);

    /**
     * @param int $signupId
     * @return SignupInterface
     */
    public function get(int $signupId): SignupInterface;

    /**
     * @param SignupInterface $object
     * @return void
     */
    public function delete(SignupInterface $object): void;

    /**
     * @param int $signupId
     * @return mixed
     */
    public function deleteById(int $signupId): void;
}
