<?php

namespace Alliance\Developers2\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Signup extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('signup', 'signup_id');
    }
}
