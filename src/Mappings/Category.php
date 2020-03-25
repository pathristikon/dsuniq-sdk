<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Mappings;

class Category extends BaseMapping
{
    /**
     * @var int
     */
    private $clientCategoryId;

    /**
     * @var int
     */
    private $dsCategoryId;

    /**
     * @var string
     */
    private $dsCategoryName;

    public function getClientCategoryId(): int
    {
        return $this->clientCategoryId;
    }

    public function setClientCategoryId(int $clientCategoryId): self
    {
        $this->clientCategoryId = $clientCategoryId;
        return $this;
    }

    public function getDsCategoryId(): int
    {
        return $this->dsCategoryId;
    }

    public function setDsCategoryId(int $dsCategoryId): self
    {
        $this->dsCategoryId = $dsCategoryId;
        return $this;
    }

    public function getDsCategoryName(): string
    {
        return $this->dsCategoryName;
    }

    public function setDsCategoryName(string $dsCategoryName): self
    {
        $this->dsCategoryName = $dsCategoryName;
        return $this;
    }

    protected function customMappings($key, $value)
    {
        if ($key === 'category') {
            $this->setClientCategoryId($value);
        }

        if ($key === 'dsCategory') {
            $this->setDsCategoryId($value['id']);
            $this->setDsCategoryName($value['name']);
        }
    }
}