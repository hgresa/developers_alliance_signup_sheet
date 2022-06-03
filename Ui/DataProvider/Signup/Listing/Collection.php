<?php

namespace Alliance\Developers2\Ui\DataProvider\Signup\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Alliance\Developers2\Api\Data\SignupInterface;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap(SignupInterface::SIGNUP_ID, 'main_table.' . SignupInterface::SIGNUP_ID);
        $this->addFilterToMap(SignupInterface::NAME, 'main_table.' . SignupInterface::NAME);
        $this->addFilterToMap(SignupInterface::DATE, 'main_table.' . SignupInterface::DATE);
        parent::_initSelect();
    }
}
