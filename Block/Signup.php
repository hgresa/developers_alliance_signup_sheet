<?php

namespace Alliance\Developers2\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Alliance\Developers2\Model\Url;
use Magento\Framework\View\Element\Html\Date;
use Magento\Framework\App\Request\DataPersistorInterface;
use Alliance\Developers2\Model\Config\Config as SignupConfig;

class Signup extends Template
{
    protected Url $url;

    protected DataPersistorInterface $dataPersistor;

    protected SignupConfig $signupConfig;

    /**
     * @param Template\Context $context
     * @param Url $url
     * @param DataPersistorInterface $dataPersistor
     * @param SignupConfig $signupConfig
     * @param array $data
     */
    public function __construct(
        Template\Context       $context,
        Url                    $url,
        DataPersistorInterface $dataPersistor,
        SignupConfig           $signupConfig,
        array                  $data = []
    )
    {
        parent::__construct($context, $data);
        $this->url = $url;
        $this->dataPersistor = $dataPersistor;
        $this->signupConfig = $signupConfig;
    }

    /**
     * @throws LocalizedException
     */
    public function getDateHtml(): string
    {
        return $this->getLayout()->createBlock(Date::class)
            ->setData(
                [
                    'name' => 'date',
                    'id' => 'date',
                    'date_format' => 'dd-MM-y',
                    'image' => $this->getViewFileUrl('Magento_Theme::calendar.png'),
                    'years_range' => '-120y:c+nn',
                    'max_date' => '-1d',
                    'change_month' => 'true',
                    'change_year' => 'true',
                    'show_on' => 'both',
                    'first_day' => 1,
                    'value' => $this->getDate()
                ]
            )
            ->toHtml();
    }

    /**
     * @return string
     */
    public function getPostActionUrl(): string
    {
        return $this->url->getSignupPostUrl();
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    private function getDataPersistorItem(string $key)
    {
        $value = $this->dataPersistor->get($key);

        if ($value) {
            $this->dataPersistor->clear($key);

            return $value;
        }

        return null;
    }

    /**
     * @return mixed|null
     */
    public function getName()
    {
        return $this->getDataPersistorItem('signupName');
    }

    /**
     * @return mixed|null
     */
    public function getDate()
    {
        return $this->getDataPersistorItem('signupDate');
    }

    public function formIsVisible(): bool
    {
        return $this->signupConfig->getFormIsVisible();
    }
}
