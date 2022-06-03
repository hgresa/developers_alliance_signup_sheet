<?php

namespace Alliance\Developers2\Model\ResourceModel\Signup;

use Alliance\Developers2\Model\ResourceModel\Signup as SignupResource;
use Alliance\Developers2\Model\Signup;
use \Magento\Eav\Model\Entity\Collection\VersionControl\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Signup::class, SignupResource::class);
    }
}
