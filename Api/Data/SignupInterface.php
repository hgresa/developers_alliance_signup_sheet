<?php

namespace Alliance\Developers2\Api\Data;

interface SignupInterface
{
    public const SIGNUP_ID = 'signup_id';
    public const NAME = 'name';
    public const DATE = 'date';

    /**
     * @return int
     */
    public function getSignupId(): int;

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $date
     * @return void
     */
    public function setDate(string $date): void;

    /**
     * @return string
     */
    public function getDate(): string;
}
