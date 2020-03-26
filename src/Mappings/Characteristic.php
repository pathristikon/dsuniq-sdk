<?php

declare(strict_types=1);

namespace Dsuniq\DsuniqSdk\Mappings;

class Characteristic
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $content;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }
}