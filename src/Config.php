<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk;

class Config
{
    /**
     * @var string
     */
    private $authToken;

    public function __construct(string $authToken)
    {
        $this->authToken = $authToken;
    }

    public function getAuthToken(): string
    {
        return $this->authToken;
    }
}