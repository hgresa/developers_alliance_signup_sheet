<?php

namespace Alliance\Developers2\Model;

use Alliance\Developers2\Api\Data\SignupInterface;
use Magento\Framework\Model\AbstractModel;

class Signup extends AbstractModel implements SignupInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Signup::class);
    }

    /**
     * @return int
     */
    public function getSignupId(): int
    {
        return $this->getData(self::SIGNUP_ID);
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $date
     * @return void
     */
    public function setDate(string $date): void
    {
        $this->setData(self::DATE, $date);
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->getData(self::DATE);
    }
}
